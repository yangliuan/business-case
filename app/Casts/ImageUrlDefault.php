<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Support\Facades\Storage;

class ImageUrlDefault implements CastsAttributes
{
    protected $filesystem_default;

    public function __construct()
    {
        $this->filesystem_default = config('filesystems.default');
    }

    /**
     * 根据文件系统默认驱动 获取文件url
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return string
     */
    public function get($model, string $key, $value, array $attributes)
    {
        if (strpos($value, 'http')) {
            return $value;
        } else {
            return Storage::disk($this->filesystem_default)->url($value);
        }
    }

    /**
     * 根据文件系统默认驱动 设置文件路径
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return string
     */
    public function set($model, string $key, $value, array $attributes)
    {
        if (in_array($this->filesystem_default, ['public']) && strpos($value, 'storage/')) {
            return explode('storage/', $value)[1];
        } elseif ($this->filesystem_default === 'oss') {
            return parse_url($value, PHP_URL_PATH);
        } else {
            return $value;
        }
    }
}
