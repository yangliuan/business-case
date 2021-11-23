<?php

namespace App\Http\Controllers\ExcelCase;

use App\Exports\ExcelDemoFromCollectionExport;
use App\Exports\ExcelDemoFromQueryExport;
use App\Exports\ExcelDemoPictureExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    /**
     * 下载导出
     * DOC:https://docs.laravel-excel.com/3.1/exports/collection.html
     * @param Request $request
     * @return binary
     */
    public function download(Request $request)
    {
        \set_time_limit(0);
        \ini_set('memory_limit', '1024M');
        return Excel::download(new ExcelDemoFromCollectionExport, 'excel-demo '.date('YmdHis').'.xlsx');
    }

    /**
     * 存储到磁盘
     * https://docs.laravel-excel.com/3.1/exports/collection.html
     *
     * @param Request $request
     * @return void
     */
    public function storeDisk(Request $request)
    {
        return Excel::store(new ExcelDemoFromCollectionExport, 'excel-demo '.date('YmdHis').'.xlsx', 'public');
    }

    /**
     * queue导出
     * DOC:https://docs.laravel-excel.com/3.1/exports/queued.html
     * DOC:https://docs.laravel-excel.com/3.1/exports/from-query.html
     *
     * @param Request $request
     * @return void
     */
    public function queue(Request $request)
    {
        //大数据导出，一定要使用from query 和 queue 导出，占用内存小,并且可以解决响应超时问题
        $res = (new ExcelDemoFromQueryExport())->queue('excel-demo '.date('YmdHis').'.xlsx', 'public');
        dump($res);
    }

    /**
     * 字段导出图片
     *
     * @param Request $request
     * @return void
     */
    public function images(Request $request)
    {
        $res = Excel::queue(new ExcelDemoPictureExport(), 'excel-demo '.date('YmdHis').'.xlsx', 'public');
        dump($res);
    }
}
