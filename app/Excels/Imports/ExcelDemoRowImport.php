<?php

namespace App\Excels\Imports;

use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing;

class ExcelDemoRowImport implements OnEachRow, WithHeadingRow, WithEvents
{
    use Importable,RegistersEventListeners;

    /**
     * 标题头行是第几行，可以指定数字，返回数字一定要和标题头的行数一致
     * DOC:https://docs.laravel-excel.com/3.1/imports/heading-row.html
     *
     * @return integer
     */
    public function headingRow(): int
    {
        //第一行是标题行
        return 1;
    }

    /**
     *
     * DOC:https://docs.laravel-excel.com/3.1/imports/model.html#handling-persistence-on-your-own
     */
    public function onRow(Row $row)
    {
        $row_index = $row->getIndex();
        $row = $row->toArray();
    }

    /**
     * 分块读取，大数据量必须要用，否则会占用很多内存导致内存溢出
     * DOC:https://docs.laravel-excel.com/3.1/imports/chunk-reading.html
     *
     * @return integer
     */
    public function chunkSize(): int
    {
        return 1000;
    }

    /**
     * beforeSheet事件，实现导入图片
     * 实现 WithEvents interface 和 RegistersEventListeners trait
     * DOC:https://docs.laravel-excel.com/3.1/imports/extending.html#auto-register-event-listeners
     * phpspreadsheet读取图片
     * DOC:https://phpspreadsheet.readthedocs.io/en/latest/topics/recipes/#reading-images-from-a-worksheet
     * REF:https://learnku.com/laravel/t/58629
     *
     * @param BeforeImport $event
     *
     * @return void
     */
    public static function afterSheet(AfterSheet $event)
    {
        dd($event->sheet->getDelegate()->getDrawingCollection());
        $i = 0;
        foreach ($event->sheet->getDelegate()->getDrawingCollection() as $drawing) {
            dd($drawing);
        }
    }
}
