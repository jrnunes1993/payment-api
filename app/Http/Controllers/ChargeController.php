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
        $this->criarCobranca();
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

    private function criarCobranca()
    {
        \PagSeguro\Library::initialize();
        \PagSeguro\Library::cmsVersion()->setName("Nome")->setRelease("1.0.0");
        \PagSeguro\Library::moduleVersion()->setName("Nome")->setRelease("1.0.0");

//Instantiate a new Boleto Object
        $boleto = new \PagSeguro\Domains\Requests\DirectPayment\Boleto();

// Set the Payment Mode for this payment request
        $boleto->setMode('DEFAULT');

        /**
         * @todo Change the receiver Email
         */
//$boleto->setReceiverEmail('vendedor@lojamodelo.com.br');

// Set the currency
        $boleto->setCurrency("BRL");

// Add an item for this payment request
        $boleto->addItems()->withParameters(
            '0001',
            'Mensalidade do Curso',
            2,
            130.00
        );


// Set a reference code for this payment request. It is useful to identify this payment
// in future notifications.
        $boleto->setReference("LIBPHP000001-boleto");


// Set your customer information.
// If you using SANDBOX you must use an email @sandbox.pagseguro.com.br
        $boleto->setSender()->setName('João Comprador');
        $boleto->setSender()->setEmail('email@comprador.com.br');

        $boleto->setSender()->setPhone()->withParameters(
            11,
            56273440
        );

        $boleto->setSender()->setDocument()->withParameters(
            'CPF',
            '85269743000'
        );

//        $boleto->setSender()->setHash('3dc25e8a7cb3fd3104e77ae5ad0e7df04621caa33e300b27aeeb9ea1adf1a24f');
//
//        $boleto->setSender()->setIp('127.0.0.0');

// Set shipping information for this payment request
        $boleto->setShipping()->setAddress()->withParameters(
            'Av. Brig. Faria Lima',
            '1384',
            'Jardim Paulistano',
            '01452002',
            'São Paulo',
            'SP',
            'BRA',
            'apto. 114'
        );

// If your payment request don't need shipping information use:
// $boleto->setShipping()->setAddressRequired()->withParameters('FALSE');

        try {
            //Get the crendentials and register the boleto payment
            $result = $boleto->register(
                \PagSeguro\Configuration\Configure::getAccountCredentials()
            );

            // You can use methods like getCode() to get the transaction code and getPaymentLink() for the Payment's URL.
            echo "<pre>";
            print_r($result);
        } catch (Exception $e) {
            echo "</br> <strong>";
            die($e->getMessage());
        }
    }
}
