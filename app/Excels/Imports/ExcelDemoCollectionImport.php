<?php

namespace App\Excels\Imports;

use App\Models\ExcelDemo;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class ExcelDemoCollectionImport implements ToCollection, WithChunkReading, WithHeadingRow
{
    /**
     * 集合导入适用于，有关联数据需要插入多表，或者需要做特殊处理的情况
     *
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        $handle_method = 'batch_insert';

        if ($handle_method == 'one_by_one') {
            //一条接一条导入，适用于复杂关联表的场景
            foreach ($rows as $row) {
                ExcelDemo::create([
                    'str_column' => $row['字符串字段'],
                    'int_column' => $row['整数字段'],
                    'float_column' => $row['浮点数字段'],
                    'pic_column' => $row['图片'],
                    'text_column' => $row['文本字段'],
                ]);
            }
        } elseif ($handle_method == 'batch_insert') {
            //在集合中手动处理批量写入,使用此方式需要在 config/excel.php配置中关闭事务配置,
            // transactions=>['db'=>null]否则可能会导致数据库长事务阻塞

            //标题头和数据库表字段映射
            $column_map = [
                '字符串字段'=>'str_column','整数字段'=>'int_column','浮点数字段'=>'float_column','图片'=>'pic_column','文本字段'=>'text_column'
            ];
            $rows = $this->covertRowData($rows, $column_map);
            //写入数据，注意chunkSize的数值不能太大，导致inset into语句 数据包过大报错
            //测试用例23567条数据，内存4096M
            //chunkSize=1 nginx504;废除
            //chunkSize=100
            //first=>postman:6m20.82s,telescope:380723ms|second=>postman:6m21.78s,telescope:381700ms|3rd=>postman:6m28.50s,telescope:388458ms
            //chunksize=800
            //first=>postman:56.54s,telescope:56495ms|second=>postman:55.57s,,telescope:55000ms|3rd=>postman:58.51s,telescope:58451ms
            //chunksize=1000
            //first=>postman:54.44s,telescope:54383ms|second=>postman:54.45s,telescope:54394ms|3rd=>postman:48.94s,telescope:48895ms
            //chunksize=1250
            //first=>postman:47.17s,telescope:47126ms|second=>postman:48.50s,telescope:48460ms|3rd=>postman:53.93s,telescope:53884ms
            //chunksize=1500
            //first=>postman:46.10s,telescope:46072ms|second=>postman:47.26s,telescope:47213ms|3rd=>postman:47.17s,telescope:47126ms
            //chunksize=1700
            //first=>postman:55.90s,telescope:55828ms|second=>postman:54.32s,telescope:54252ms|3rd=>postman:55.21s,telescope:55165ms
            //chunkSize=2000
            //first=>postman:1m6.78s,telescope:66736ms|second=>postman:1m13.98s,telescope:73934ms|3rd=>postman:1m8.40s,telescope:68347ms
            ExcelDemo::insert($rows);
        }
    }

    /**
     * 标题头行是第几行，可以指定数字，返回数字一定要和标题头的行数一致
     * DOC:https://docs.laravel-excel.com/3.1/imports/heading-row.html
     *
     * @return integer
     */
    public function headingRow(): int
    {
        return 1;
    }

    /**
     * 分块读取，大数据量必须要用，否则会占用很多内存导致内存溢出
     * DOC:https://docs.laravel-excel.com/3.1/imports/chunk-reading.html
     * @return integer
     */
    public function chunkSize(): int
    {
        return 1100;
    }

    /**
     * 自定义方法取出需要的数据
     *
     * @param collect $rows
     * @param array $column_map 标题头和表字段映射
     * @return array
     */
    public function covertRowData($rows, $column_map)
    {
        $result = [];
        $i = 0;
        $now = now();

        foreach ($rows as $key => & $row) {
            foreach ($column_map as $key => $value) {
                $result[$i][$value] = $row[$key];
            }
            $result[$i]['created_at'] = $now;
            $result[$i]['updated_at'] = $now;
            $i++;
        }

        return $result;
    }
}
