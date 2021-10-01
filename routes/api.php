<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BarangController;
use App\Http\Controllers\Api\DetailBarangController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('logout', [AuthController::class, 'logout']); 

    Route::get('barang', [BarangController::class, 'index']); 
    Route::post('barang', [BarangController::class, 'store']); 
    Route::get('barang/{barang}', [BarangController::class, 'show']); 
    Route::put('barang/{barang}', [BarangController::class, 'update']); 
    Route::delete('barang/{barang}', [BarangController::class, 'destory']); 

    Route::get('detail_barang', [DetailBarangController::class, 'index']); 
    Route::post('detail_barang', [DetailBarangController::class, 'store']); 
});

Route::post('register', [AuthController::class, 'register']); 
Route::post('login', [AuthController::class, 'login']); 
