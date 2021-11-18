<?php

namespace App\Exports;

use App\Models\ExcelDemo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Color;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class ExcelDemoExport implements FromCollection, WithMapping, WithHeadings, WithColumnFormatting, WithColumnWidths, ShouldAutoSize, WithStyles, WithDrawings
{
    /**
     * 执行查询获取数据集合
     * DOC:https://docs.laravel-excel.com/3.1/exports/collection.html
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $demos = ExcelDemo::select()
            ->get();

        return $demos;
    }

    /**
     * excel表头
     * DOC:https://docs.laravel-excel.com/3.1/exports/mapping.html#adding-a-heading-row
     * @return array
     */
    public function headings(): array
    {
        return [
            '字符串字段',
            '整数字段',
            '浮点数字段',
            '图片字段',
            '文本字段',
            '创建时间'
        ];
    }

    /**
     * 表头 对应数据映射
     * DOC:https://docs.laravel-excel.com/3.1/exports/mapping.html#mapping-rows
     * @param obj $book
     * @return array
     */
    public function map($demo): array
    {
        return [
            $demo->str_column,
            $demo->int_column,
            $demo->float_column,
            $demo->pic_column,
            $demo->text_column,
            $demo->created_at
            //Date::dateTimeToExcel($demo->created_at),
        ];
    }

    /**
     * 字段 格式化数据类型
     * DOC:https://docs.laravel-excel.com/3.1/exports/column-formatting.html#formatting-columns
     * @return array
     */
    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_TEXT,
            'B' => NumberFormat::FORMAT_NUMBER,
            'C' => NumberFormat::FORMAT_NUMBER_00,
            'D'=> NumberFormat::FORMAT_TEXT,
            'E'=> NumberFormat::FORMAT_TEXT,
        ];
    }

    /**
     * 字段宽度设定，默认按ShouldAutoSize接口自动适应宽度
     * DOC:https://docs.laravel-excel.com/3.1/exports/column-formatting.html#column-widths
     * @return array
     */
    public function columnWidths(): array
    {
        return [
            //'A'=>100,
            //'B'=>100,
            //'C'=>100,
            'D'=>60,
            'E'=>300,
            'F'=>20,
        ];
    }

    /**
     * 设置样式 版本v3.1.21 以后
     * DOC:https://docs.laravel-excel.com/3.1/exports/column-formatting.html#styling
     * DOC:https://phpspreadsheet.readthedocs.io/en/latest/topics/recipes/#styles
     * @param Worksheet $sheet
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        return [
            //第一行
            1 => [
                //字体设置
                'font' => [
                    //设置粗体
                    'bold' => true ,
                    //字体颜色
                    'color'=>[
                        'argb'=> Color::COLOR_RED
                    ]
                ],
                //水平居中
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                ],
                //背景填充
                'fill' => [
                    //填充方式线性
                    'fillType' => Fill::FILL_GRADIENT_LINEAR,
                    'rotation' => 90,
                    //渐变开始颜色
                    'startColor' => [
                        'argb' => 'FFA0A0A0',
                    ],
                    //渐变结束颜色
                    'endColor' => [
                        'argb' => 'FFFFFFFF',
                    ],
                ],
            ],

            //第一列
            'A' => [
                //字体设置
                'font' => [
                    //设置斜体
                    'italic' => true,
                    //颜色设置
                    'color' => [
                        'argb'=> Color::COLOR_GREEN
                    ],
                    'size' => 16,
                ],
                //水平居中
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                ],
                //背景填充
                'fill' => [
                    'startColor' => [
                        'argb' => Color::COLOR_RED,
                    ]
                ],
            ]
        ];
    }

    /**
     * 图片
     *
     * @return void
     */
    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('This is my logo');
        $drawing->setPath(public_path('/img/logo.jpg'));
        $drawing->setHeight(90);
        $drawing->setCoordinates('D');

        return $drawing;
    }
}
