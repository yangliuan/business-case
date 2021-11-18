<?php

namespace App\Http\Controllers\ExcelCase;

use App\Exports\ExcelDemoExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function download(Request $request)
    {
        return Excel::download(new ExcelDemoExport, 'excel-demo '.date('YmdHis').'.xlsx');
    }
}
