<?php

namespace App\Http\Controllers;

use App\Models\Sample_data;
use DataTables;
use App\Datatables\StaffDataTable;
use Yajra\DataTables\Services\DataTable;



use Illuminate\Http\Request;

class SampleController extends Controller
{
    
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Sample_data::latest()->get();
            return  $dataTable::of($data)
                    ->addColumn('action', function($data){
                        $btn =  '< button type="button" name="edit" id="'.$data->id.'"
                        class="edit btn btn-primary btn-sm">Edit</button>';
                        $btn =  '$nbsp;$nbsp;$nbsp;< button type="button" name="Delete" id="'.$data->id.'"
                        class="delete btn btn-danger btn-sm">Delete</button>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
                    return view('sample_data');
                }
            }
}
