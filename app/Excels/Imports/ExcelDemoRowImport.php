<?php

namespace App\Excels\Imports;

use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;

class ExcelDemoRowImport implements OnEachRow
{
    /**
     *
     * DOC:https://docs.laravel-excel.com/3.1/imports/model.html#handling-persistence-on-your-own
     */
    public function onRow(Row $row)
    {
        $row_index = $row->getIndex();
        $row = $row->toArray();
        dd($row_index, $row);
    }
}
