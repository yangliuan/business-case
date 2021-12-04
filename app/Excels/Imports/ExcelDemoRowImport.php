<?php

namespace App\Excels\Imports;

use App\Models\ExcelDemo;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Events\AfterImport;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing;

class ExcelDemoRowImport implements OnEachRow, WithHeadingRow, WithEvents
{
    use Importable,RegistersEventListeners;

    public $disk;

    public $excel_path;

    public function __construct(string $disk, string $excel_path)
    {
        $this->disk = $disk;
        $this->excel_path = $excel_path;
    }

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
     * 逐行处理
     * DOC:https://docs.laravel-excel.com/3.1/imports/model.html#handling-persistence-on-your-own
     *
     * 导入图片
     * REF:https://laracasts.com/discuss/channels/laravel/cant-import-images-using-laravel-excel
     * DOC:https://phpspreadsheet.readthedocs.io/en/latest/topics/recipes/#reading-images-from-a-worksheet
     */
    public function onRow(Row $row)
    {
        $row_index = $row->getIndex();
        $row = $row->toArray();
        //excel完整路径
        $full_path = Storage::disk($this->disk)->path($this->excel_path);
        $spreadsheet = IOFactory::load($full_path);

        foreach ($spreadsheet->getActiveSheet()->getDrawingCollection() as $drawing) {
            if ($drawing instanceof MemoryDrawing) {
                ob_start();
                call_user_func(
                    $drawing->getRenderingFunction(),
                    $drawing->getImageResource()
                );
                $image_contents = ob_get_contents();
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
                $zipReader = fopen($drawing->getPath(), 'r');
                $image_contents = '';
                while (!feof($zipReader)) {
                    $image_contents .= fread($zipReader, 1024);
                }
                fclose($zipReader);
                $extension = $drawing->getExtension();
            }
        }

        $my_file_name = 'excel_upload/'. md5(time().mt_rand(100000, 999999)) . '.' . $extension;
        $put_res = Storage::disk($this->disk)->put($my_file_name, $image_contents);
        //保存图片成功
        if ($put_res) {
            ExcelDemo::create([
                'int_column'=>$row['ID'],//将id存入数字字段，看一下图片和数据行数是否匹配
                'pic_column'=>$my_file_name
            ]);
        }
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

    public static function afterImport(AfterImport $event)
    {
        Storage::disk(self::$disk)->delete(self::$excel_path);
    }
}
