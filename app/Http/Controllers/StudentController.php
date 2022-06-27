<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class StudentController extends Controller
{
    // public function index()
    // {
    //     $students = Student::all();
    //     return view('students.list', ['data' => $students]);
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Student::all();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<div class="center"><a href="/students/' . $row->id . '" class="edit btn btn-primary btn-sm">Editar</a></div>';
                        return $btn;
                    })
                    ->addColumn('statusStr', function($row){
                        $status = $row->getStatusStr();
                        return $status;

                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        
        return view('students.list');
    }

    public function view($id){
        $student = Student::find($id);
        return view('students.view', ['data' => $student]);
    }

}
