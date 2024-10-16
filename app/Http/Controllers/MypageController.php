<?php

namespace App\Http\Controllers;

use App\Models\User;
use Barryvdh\Debugbar\Facades\Debugbar;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use App\Services\FileService;

class MypageController extends Controller
{
    protected FileService $fileService;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    public function overview()
    {
        return Inertia::render('Mypage/Overview', [
            'user_created_at' => str_replace('-', '.', substr(auth()->user()->created_at, 0, 10)),
            'profile_photo_path' => auth()->user()->profile_photo_path,
        ]);
    }

    public function profileUpload(Request $request)
    {
        $request->validate([
            'profile' => ['nullable', 'sometimes', 'image', 'max:3072', 'mimes:jpeg,png,jpg,gif'],
        ], [
            'profile.image' => '이미지 파일만 업로드 가능합니다.',
            'profile.mimes' => '이미지는 jpeg, png, jpg, gif 형식만 가능합니다.',
            'profile.max' => '최대 3MB 업로드 가능합니다.',
        ]);

        try {
            $uploadFile = $this->fileService->uploadProfileFile($request->profile);

            $profileData = [
                'profile_photo_path' => $uploadFile['fileSource'],
            ];
            User::where('id', auth()->id())->update($profileData);

            return redirect()->route('mypage.overview');
        }catch (Exception $e) {
            Debugbar::error('Mypage.profileUpload : ' . $e->getMessage());
            throw ValidationException::withMessages([
                'profile' => '이미지를 업로드할 수 없습니다.',
            ]);
        }
    }

    public function profileDestroy()
    {
        try {
            $this->fileService->deleteFileOnServer('profiles', auth()->user()->profile_photo_path);
            User::where('id', auth()->id())->update([
                'profile_photo_path' => null,
            ]);
            return redirect()->route('mypage.overview');
        }catch (Exception $e) {
            Debugbar::error('MyOverview.profileDestroy : ' . $e->getMessage());
            throw ValidationException::withMessages([
                'profile' => '이미지를 삭제할 수 없습니다.',
            ]);
        }
    }
}
