<?php

use App\Http\Controllers\ApiClientesController;
use App\Http\Controllers\ApiContasController;
use App\Http\Controllers\ApiLoginController;
use App\Http\Controllers\ApiRecebiveisController;
use App\Http\Controllers\ApiTegController;
use App\Http\Controllers\ApiUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::get('listContas/{id}', [ApiContasController::class, 'listContas'])->name('listContas');
Route::post('addContas', [ApiContasController::class, 'addContas'])->name('addContas');
Route::put('update/{id}', [ApiContasController::class, 'update'])->name('update');
Route::delete('delete/{id}', [ApiContasController::class, 'delete'])->name('delete');

Route::get('listRecebiveis/{id}', [ApiRecebiveisController::class, 'listRecebiveis'])->name('listRecebiveis');
Route::post('addRecebiveis', [ApiRecebiveisController::class, 'addRecebiveis'])->name('addRecebiveis');
Route::put('upRecebiveis/{id}', [ApiRecebiveisController::class, 'upRecebiveis'])->name('upRecebiveis');
Route::delete('deleteRecebiveis/{id}', [ApiRecebiveisController::class, 'delete'])->name('deleteRecebiveis');

Route::post('addCliente', [ApiClientesController::class, 'addCliente'])->name('addCliente');
Route::put('upCliente/{id}', [ApiClientesController::class, 'upCliente'])->name('upCliente');
Route::delete('deleteCliente/{id}', [ApiClientesController::class, 'deleteCliente'])->name('deleteCliente');

Route::post('addTag', [ApiTegController::class, 'addTag'])->name('addTag');
Route::delete('DelTag/{id}', [ApiTegController::class, 'DelTag'])->name('DelTag');

Route::get('listUsers', [ApiUserController::class, 'listUsers'])->name('listUsers');
Route::post('addUsers', [ApiUserController::class, 'addUsers'])->name('addUsers');
Route::put('upUsers/{id}', [ApiUserController::class, 'upUsers'])->name('upUsers');
Route::delete('delUsers/{id}', [ApiUserController::class, 'delete'])->name('delUsers');

Route::post('login', [ApiLoginController::class, 'login'])->name('login');
