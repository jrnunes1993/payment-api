<?php

use App\Helpers\StringHelper;
use Illuminate\Support\Facades\Route;

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
    echo 'foi, ';
    echo StringHelper::random(['Registered', 'Locked', 'Canceled']);
});
