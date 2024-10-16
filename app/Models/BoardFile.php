<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;

/**
 *
 *
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $table_name 테이블 명
 * @property int $target_id 테이블 ID
 * @property string $file_full_name 파일명
 * @property float $file_size 파일 크기
 * @property int $is_delete 삭제 여부
 * @property string|null $deleted_at 삭제 시간
 * @method static Builder|File newModelQuery()
 * @method static Builder|File newQuery()
 * @method static Builder|File query()
 * @method static Builder|File whereCreatedAt($value)
 * @method static Builder|File whereDeletedAt($value)
 * @method static Builder|File whereFileFullName($value)
 * @method static Builder|File whereFileSize($value)
 * @method static Builder|File whereId($value)
 * @method static Builder|File whereIsDelete($value)
 * @method static Builder|File whereTableName($value)
 * @method static Builder|File whereTargetId($value)
 * @method static Builder|File whereUpdatedAt($value)
 * @mixin Eloquent
 */
class BoardFile extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'table_name',
        'target_id',
        'file_full_name',
        'file_size',
        'is_delete',
    ];
}
