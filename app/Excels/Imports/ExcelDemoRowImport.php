<?php

namespace App\Excels\Imports;

use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;

class ExcelDemoRowImport implements OnEachRow
{
    public function onRow(Row $row)
    {
        $row_index = $row->getIndex();
        $row = $row->toArray();
        dd($row_index, $row);
    }
}
