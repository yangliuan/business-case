<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Support\Facades\Storage;

class ImageUrlByDisk implements CastsAttributes
{
    /**
     * 根据磁盘 获取文件url 查询出的模型必须包含disk属性
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return string
     */
    public function get($model, string $key, $value, array $attributes)
    {
        if (strpos($value, 'http') === 0) {
            return $value;
        } else {
            return Storage::disk($model->disk)->url($value);
        }
    }

    /**
     * 根据磁盘 设置文件路径 查询出的模型必须包含disk属性
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return string
     */
    public function set($model, string $key, $value, array $attributes)
    {
        if (strpos($value, 'http') === 0) {
            if (in_array($model->disk, ['public']) && strpos($value, 'storage/')) {
                return explode('storage/', $value)[1];
            } elseif ($model->disk === 'oss') {
                return parse_url($value, PHP_URL_PATH);
            }
        } else {
            return $value;
        }
    }
}
