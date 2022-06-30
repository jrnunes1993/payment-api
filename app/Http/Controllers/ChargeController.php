<?php

namespace App\Http\Controllers;

use App\Helpers\NumberHelper;
use App\Models\Charge;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ChargeController extends Controller
{
    public function index(Request $request, int $studentId = 0)
    {
        if ($request->ajax()) {
            if ($studentId == 0) {
                $data = Charge::all();
            } else {
                $data = Charge::where('studentId', $studentId);
            }

            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<div class="center"><a href="/charges/form/' . $row->id . '" class="edit btn btn-primary btn-sm">Editar</a></div>';
                        return $btn;
                    })
                    ->addColumn('statusStr', function($row){
                        $status = $row->getStatusStr();
                        return $status;
                    })
                    ->addColumn('typeStr', function($row){
                        $type = $row->getTypeStr();
                        return $type;
                    })
                    ->addColumn('studentName', function($row){
                        $name = $row->student()->name;
                        return $name;
                    })
                    ->addColumn('valueFmt', function($row){
                        return NumberHelper::formatNumber($row->value);
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('charges.list');
    }
}
