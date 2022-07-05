<?php

namespace App\Http\Controllers;

use App\Helpers\NumberHelper;
use App\Helpers\StringHelper;
use App\Models\Charge;
use App\Models\Student;
use Exception;
use Illuminate\Http\Request;
use PagSeguro\Configuration\Configure;
use PagSeguro\Domains\Requests\DirectPayment\Boleto;
use PagSeguro\Library;
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
                ->addColumn('link', function ($row) {
                    if ($row->paymentLink != '') {
                        $link = '<div class="center"><a href="' . $row->paymentLink . '" target="_blank" class="edit btn btn-primary btn-sm">Ver</a></div>';
                    } else {
                        $link = '<div class="center"></div>';
                    }
                    return $link;
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
                ->rawColumns(['action','link'])
                ->make(true);
        }

        return view('charges.list');
    }

    public function view($chargeId)
    {
        $charge = Charge::find($chargeId);
        if ($charge == null) {
            $charge = new Charge([
                'studentId' => 0,
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
        $value = NumberHelper::formatNumberToDB($request->value);
        try {
            $resultPostCriaBoleto = $this->gerarBoletoApi(Student::find($request->studentId), $value);
        } catch (Exception $e) {
            return redirect('charges/form/' . (int) $request->id)
                ->with('message', "Erro registrando cobrança: " . $e->getMessage())
                ->with('messageType', "alert-danger");
        }

        if ($request->id == 0) {
            $charge = new Charge();
            $message = 'adicionado';
        } else {
            $charge = Charge::find($request->id);
            $message = 'atualizado';
        }

        $requestData = $request->all();
        $requestData['value'] = $value;
        $charge->fill($requestData);
        $charge->paymentLink = $resultPostCriaBoleto->getPaymentLink();
        $charge->referenceId = $resultPostCriaBoleto->getCode();

        $charge->save();

        return redirect('charges/form/' . $charge->id)
            ->with('message', "Registro de Cobrança $message com sucesso.")
            ->with('messageType', "alert-success");
    }

    /**
     * @param Student $student
     * @param $valor
     * @throws Exception
     */
    private function gerarBoletoApi(Student $student, $valor)
    {
        Library::initialize();
        Library::cmsVersion()->setName("Nome")->setRelease("1.0.0");
        Library::moduleVersion()->setName("Nome")->setRelease("1.0.0");

        $boleto = new Boleto();

        $boleto->setMode('DEFAULT');

        /**
         * @todo Change the receiver Email
         */
        //$boleto->setReceiverEmail('vendedor@lojamodelo.com.br');

        $boleto->setCurrency("BRL");

        $boleto->addItems()->withParameters(
            '0001',
            'Mensalidade do Curso',
            1,
            $valor
        );

        $boleto->setReference("LIBPHP000001-boleto");

        $boleto->setSender()->setName($student->name);
        $boleto->setSender()->setEmail($student->email);

        $boleto->setSender()->setPhone()->withParameters(
            11,
            56273440
        );

        $boleto->setSender()->setDocument()->withParameters(
            'CPF',
            $student->document
            //'85269743000'
        );

        $boleto->setShipping()->setAddress()->withParameters(
            $student->street,
            $student->number,
            $student->locality,
            $student->postalCode,
            $student->city,
            $student->state,
            'BRA',
            ''
        );

        $result = $boleto->register(
            Configure::getAccountCredentials()
        );
        return (Object) $result;
    }
}
