<?php

namespace App\Traits;

trait WriteTextToImageTrait
{
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
    public function autowrap($fontsize, $angle, $fontface, $text, $width)
    {
        $content = '';
        //将字符串拆分成一个个单字 保存到数组 letter 中
        preg_match_all("/./u", $text, $arr);
        $words = $arr[0];

        foreach ($words as $word)
        {
            $tmpText = $content . $word;
            $tmpTextBox = imagettfbbox($fontsize, $angle, $fontface, $tmpText);

            if (($tmpTextBox[2] > $width) && ($content !== ""))
            {
                $content .= PHP_EOL;
            }
            else
            {
                $content .= $word;
            }
        }

        return $content;
    }

    public function getFontWidthHeight($fontSize, $angle, $fontFace, $text)
    {
        $box = imagettfbbox($fontSize, $angle, $fontFace, $text);
        $width = $box[2] - $box[0];
        $height = $box[1] - $box[7];

        return [$width, $height];
    }
}
