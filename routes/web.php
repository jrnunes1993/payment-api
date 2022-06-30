<?php

use App\Http\Controllers\ChargeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\MainController;
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

Route::get('/', [MainController::class, 'index']);

Route::get('students', [StudentController::class, 'index'])->name('student.index');
Route::get('students/{studentId}', [StudentController::class, 'view']);
Route::post('students/store', [StudentController::class, 'store']);

Route::get('charges', [ChargeController::class, 'index'])->name('charge.index');
Route::get('charges/{studentId}', [ChargeController::class, 'index'])->name('charge.datatable');