<?php

use Illuminate\Support\Facades\Route;
use Rockbuzz\SDKYapay\PaymentCreditCardFactory;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**TODO
 * 1) Mover esse codigo para um controller
 * 2) Verificar porque esta sendo esperado 2 caracteres no campo City
 *
 * Exemplo de consumo em: https://github.com/rockbuzz/sdk-yapay
 */
Route::get('/', function () {

    $params = [
        'store_code' => 1234,
        'username' => 'teste',
        'password' => 'teste',
        'endpoint' => 'https://sandbox.gateway.yapay.com.br/checkout/api/v3/transacao',
        'transaction_number' => 1234,
        'transaction_value' => 1598,
        'transaction_installments' => 5,
        'transaction_notification_url' => 'http://notificationUrl.com',
        'creditcard_name' => 'Holder Name',
        'creditcard_number' => 0000000000000000,
        'creditcard_code' => 123,
        'transaction_due_date' => 1111111111,
        'creditcard_month' => 10,
        'creditcard_year' => 2020,
        'items' => [
            [
                'id' => 1234,
                'name' => 'Product Name',
                'price_in_cents' => 15987,
                'quantity' => 1
            ],
            [
                'id' => 2345,
                'name' => 'Product Name',
                'price_in_cents' => 15990,
                'quantity' => 1
            ]
        ],
        'customer_id' => 1234,
        'customer_name' => 'Antonio Nunes Moreira Junior',
        'customer_document' => 12345678900,
        'email' => 'nunesjr19933@gmail.com',
        'street' => 'Barro Vermelho',
        'number' => 298,
        'postal_code' => '91790100',
        'neighborhood' => 'Center',
        'city' => 'PO',
        'state' => 'RS',
        'complement' => '',
        'country' => 'BR'
    ];

    try {
        $payment = PaymentCreditCardFactory::fromArray($params);
        $result = $payment->done();
        dd($result);
    } catch (\Exception $e) {
        dd($e->getMessage());
    }
});
