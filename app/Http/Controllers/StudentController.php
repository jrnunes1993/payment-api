<?php

namespace App\Http\Controllers;

use App\Helpers\CountryStates;
use App\Models\Student;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class StudentController extends Controller
{
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
        if ($student == null) {
            $student = new Student([
                'state' => 'RS',
                'country' => 'Brasil',
                ''
            ]);
        }
        return view('students.view', [
            'data' => $student, 
            'states' => CountryStates::getStates(), 
            'postals' => CountryStates::getPostals()
        ]);
    }

    public function store(Request $request){
        if ($request->id == 0) {
            $data = new Student;
            $message = 'adicionado';
        } else {
            $data = Student::find($request->id);
            $message = 'atualizado';
        }
        
        $data->name = $request->name;
        $data->email = $request->email;
        $data->status = $request->status;
        $data->document = $request->document;
        $data->phoneNumber = $request->phoneNumber;
        $data->country = $request->country;
        $data->city = $request->city;
        $data->street = $request->street;
        $data->number = $request->number;
        $data->locality = $request->locality;
        $data->state = $request->state;
        $data->postalCode = $request->postalCode;

        $data->save();

        return redirect('students/' . $data->id)->with('message', "Registro de Estudante $message com sucesso.");
    }

}
