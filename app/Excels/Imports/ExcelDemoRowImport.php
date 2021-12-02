<?php

namespace App\Excels\Imports;

use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Events\BeforeSheet;
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
     *
     * @param BeforeImport $event
     *
     * @return void
     */
    public static function beforeSheet(BeforeSheet $event)
    {
        dd($event->sheet);
        $i = 0;
        foreach ($event->sheet->getActiveSheet()->getDrawingCollection() as  $drawing) {
            if ($drawing instanceof MemoryDrawing) {
                ob_start();
                call_user_func(
                    $drawing->getRenderingFunction(),
                    $drawing->getImageResource()
                );
                $imageContents = ob_get_contents();
                ob_end_clean();
                switch ($drawing->getMimeType()) {
                    case MemoryDrawing::MIMETYPE_PNG:
                        $extension = 'png';
                        break;
                    case MemoryDrawing::MIMETYPE_GIF:
                        $extension = 'gif';
                        break;
                    case MemoryDrawing::MIMETYPE_JPEG:
                        $extension = 'jpg';
                        break;
                }
            } else {
                if ($drawing->getPath()) {
                    // Check if the source is a URL or a file path
                    if ($drawing->getIsURL()) {
                        $imageContents = file_get_contents($drawing->getPath());
                        $filePath = tempnam(sys_get_temp_dir(), 'Drawing');
                        file_put_contents($filePath, $imageContents);
                        $mimeType = mime_content_type($filePath);
                        // You could use the below to find the extension from mime type.
                        // https://gist.github.com/alexcorvi/df8faecb59e86bee93411f6a7967df2c#gistcomment-2722664
                        $extension = File::mime2ext($mimeType);
                        unlink($filePath);
                    } else {
                        $zipReader = fopen($drawing->getPath(), 'r');
                        $imageContents = '';
                        while (!feof($zipReader)) {
                            $imageContents .= fread($zipReader, 1024);
                        }
                        fclose($zipReader);
                        $extension = $drawing->getExtension();
                    }
                }
            }
            $myFileName = '00_Image_'.++$i.'.'.$extension;
            file_put_contents($myFileName, $imageContents);
        }
    }
}
