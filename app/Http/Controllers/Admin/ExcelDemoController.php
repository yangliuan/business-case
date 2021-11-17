<?php

namespace App\Http\Controllers\Admin;

use App\Models\ExcelDemo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ExcelDemoRequest;
use App\Filters\Admin\ExcelDemoFilter;

class ExcelDemoController extends Controller
{
	public function index(ExcelDemoRequest $request)
	{
		$excel_demos = ExcelDemo::select()
			->filter($request->all(),ExcelDemoFilter::class)
			->latest()
			->paginate($request->input('per_page',15));

		return response()->json($excel_demos);
	}

	public function store(ExcelDemoRequest $request)
	{
		$data = $request->filter();
		$excel_demo = ExcelDemo::create($data);

		return response()->json(['id'=>$excel_demo->id]);
	}

    public function show($id)
    {
		$excel_demo = ExcelDemo::find($id);

        return response()->json($excel_demo);
    }

	public function update(ExcelDemoRequest $request,$id)
	{
        $excel_demo = ExcelDemo::findOrFail($id);
		$data = $request->filter();
		$excel_demo->update($data);

		return response()->json();
	}

	public function destroy($id)
	{
		$excel_demo = ExcelDemo::findOrFail($id);
		$excel_demo->delete();

		return response()->json();
	}
}
