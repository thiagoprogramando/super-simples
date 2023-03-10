<?php

use App\Http\Controllers\ApiContasController;
use App\Http\Controllers\ApiRecebiveisController;
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