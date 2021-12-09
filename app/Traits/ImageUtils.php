<?php
namespace App\Traits;

use Intervention\Image\Facades\Image;

trait ImageUtils
{
    /**
     * 将base64图片保存为二进制文件,存储在本地
     *
     * @param string $imgBase64String
     * @return void
     */
    public function saveBase64ImageToBin(string $imgBase64String)
    {
        $imgBase64String = str_replace('data:image/jpeg;base64,', '', $imgBase64String);

        $imgBase64String = preg_replace("/\r\n/", "", $imgBase64String);

        $fileName = time() . '.jpg';

        $savePath = storage_path('app/public/' . $fileName);

        Image::make($imgBase64String)->save($savePath, 75, 'jpg');

        return asset('storage/' . $fileName);
    }

    /**
     * 写入图片文本计算自动换行
     *
     * @param int $fontsize 字体
     * @param int $angle 角度
     * @param string $fontface 字体文件路径
     * @param string $text 文字
     * @param int $width 宽度
     * @return string
     */
    public function textAutowrapInImage($fontsize, $angle, $fontface, $text, $width)
    {
        $content = '';
        //将字符串拆分成一个个单字 保存到数组 letter 中
        preg_match_all("/./u", $text, $arr);
        $words = $arr[0];

        foreach ($words as $word) {
            $tmpText = $content . $word;
            $tmpTextBox = imagettfbbox($fontsize, $angle, $fontface, $tmpText);

            if (($tmpTextBox[2] > $width) && ($content !== "")) {
                $content .= PHP_EOL;
            } else {
                $content .= $word;
            }
        }

        return $content;
    }

    /**
     * 计算字体文本在图片中的宽度
     *
     * @param [type] $fontSize
     * @param [type] $angle
     * @param [type] $fontFace
     * @param [type] $text
     * @return void
     */
    public function getFontWidthHeightInImage($fontSize, $angle, $fontFace, $text)
    {
        $box = imagettfbbox($fontSize, $angle, $fontFace, $text);
        $width = $box[2] - $box[0];
        $height = $box[1] - $box[7];

        return [$width, $height];
    }
}
