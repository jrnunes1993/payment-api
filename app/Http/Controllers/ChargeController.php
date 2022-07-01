<?php

namespace App\Http\Controllers;

use App\Helpers\NumberHelper;
use App\Helpers\StringHelper;
use App\Models\Charge;
use App\Models\Student;
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
                ->addColumn('action', function ($row) {
                    $btn = '<div class="center"><a href="/charges/form/' . $row->id . '" class="edit btn btn-primary btn-sm">Editar</a></div>';
                    return $btn;
                })
                ->addColumn('statusStr', function ($row) {
                    $status = $row->getStatusStr();
                    return $status;
                })
                ->addColumn('typeStr', function ($row) {
                    $type = $row->getTypeStr();
                    return $type;
                })
                ->addColumn('studentName', function ($row) {
                    $name = $row->student()->name;
                    return $name;
                })
                ->addColumn('valueFmt', function ($row) {
                    return $row->getValue();
                })
                ->addColumn('dueDateFmt', function ($row) {
                    return $row->getDueDate();
                })
                ->addColumn('paidedAtFmt', function ($row) {
                    return $row->getPaidedAt();
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('charges.list');
    }

    public function view($chargeId)
    {
        $charge = Charge::find($chargeId);
        if ($charge == null) {
            $charge = new Charge([
                'studentId' => 1,
                'status' => 'Pending',
            ]);
            $student = new Student();
        } else {
            $student = $charge->student();
        }

        return view('charges.view', [
            'data'          => $charge,
            'studentData'   => $student,
            'paimentTypeKey'   => array_keys(StringHelper::getPaymentTypeList()),
            'paimentTypeVal'   => array_values(StringHelper::getPaymentTypeList()),
            'paimentStatusKey' => array_keys(StringHelper::getPaimentStatusList()),
            'paimentStatusVal' => array_values(StringHelper::getPaimentStatusList()),
        ]);
    }

    public function store(Request $request)
    {
        if ($request->id == 0) {
            $charge = new Charge();
            $message = 'adicionado';
        } else {
            $charge = Charge::find($request->id);
            $message = 'atualizado';
        }

        $requestData = $request->all();
        $requestData['value'] = NumberHelper::formatNumberToDB($requestData['value']);
        $charge->fill($requestData);

        $charge->save();
        return redirect('charges/form/' . $charge->id)->with('message', "Registro de Cobrança $message com sucesso.");
    }
}
