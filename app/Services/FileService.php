<?php
namespace App\Services;

use Illuminate\Support\Facades\File as FacadesFile;
use Illuminate\Support\Facades\Storage;

class FileService
{
    public function uploadProfileFile($file): array
    {
        $fileName = $file->hashName();
        $destinationPath = 'profiles/' . $fileName;

        // GD 라이브러리를 사용하여 이미지 크기 조정
        $srcImage = null;
        switch ($file->getClientOriginalExtension()) {
            case 'jpeg':
            case 'jpg':
                $srcImage = imagecreatefromjpeg($file->getPathname());
                break;
            case 'png':
                $srcImage = imagecreatefrompng($file->getPathname());
                break;
            case 'gif':
                $srcImage = imagecreatefromgif($file->getPathname());
                break;
        }

        $maxWidth = 128;
        $maxHeight = 128;
        list($width, $height) = getimagesize($file->getPathname());
        $ratio = min($maxWidth / $width, $maxHeight / $height);
        $newWidth = (int)($width * $ratio);
        $newHeight = (int)($height * $ratio);

        $dstImage = imagecreatetruecolor($newWidth, $newHeight);
        imagecopyresampled($dstImage, $srcImage, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

        // 임시 파일에 이미지 저장
        $tempPath = tempnam(sys_get_temp_dir(), 'resized');
        switch ($file->getClientOriginalExtension()) {
            case 'jpeg':
            case 'jpg':
                imagejpeg($dstImage, $tempPath, 90); // 품질 90%
                break;
            case 'png':
                imagepng($dstImage, $tempPath, 9); // 압축 레벨 9
                break;
            case 'gif':
                imagegif($dstImage, $tempPath);
                break;
        }

        // 스토리지에 이미지 저장
        Storage::disk('public')->put($destinationPath, file_get_contents($tempPath));

        // 메모리 해제
        imagedestroy($srcImage);
        imagedestroy($dstImage);
        unlink($tempPath);

        return [
            'fileSource' => $fileName,
        ];
    }

    public function deleteFileOnServer($folderName, $fileName): void
    {
        $request->test;
        $dir = storage_path('app/public/'. $folderName);
        $path = "$dir/$fileName";
        if(FacadesFile::exists($path)) {
            $thumbnailPath = "$dir/thumb_$fileName";
            if (FacadesFile::exists($thumbnailPath)) {
                FacadesFile::delete($thumbnailPath);
            }
            FacadesFile::delete($path);
        }
    }
}
