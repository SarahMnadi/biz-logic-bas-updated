<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Employee;
use DataTables;


class EmployeeController extends Controller
{
    public function data()
{
    $customers = Customer::all();
    return datatables()->of($customers)
        ->addColumn('action', function ($row) {
            $html = '<a href="#" class="btn btn-xs btn-secondary">Edit</a> ';
            $html .= '<button data-rowid="'.$row->id.'" class="btn btn-xs btn-danger">Del</button>';
            return $html;
        })->toJson();
}
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>;
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('user.profile');
    }
}
}
