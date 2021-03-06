<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BarangController;
use App\Http\Controllers\Api\DetailBarangController;
use App\Http\Controllers\Api\RentalController;
use App\Http\Controllers\Api\SewaController;
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

Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::get('barang', [BarangController::class, 'index']); 
    Route::post('barang', [BarangController::class, 'store']); 
    Route::get('barang/{barang}', [BarangController::class, 'show']); 
    Route::put('barang/{barang}', [BarangController::class, 'update']); 
    Route::delete('barang/{barang}', [BarangController::class, 'destory']); 

    Route::post('detail_barang', [DetailBarangController::class, 'store']); 
    Route::get('detail_barang/{id}', [DetailBarangController::class, 'show']); 
    Route::put('detail_barang/{detail_barang}', [DetailBarangController::class, 'update']); 
    Route::delete('detail_barang/{detail_barang}', [DetailBarangController::class, 'destory']);

    Route::put('rental', [RentalController::class, 'update']); 

    Route::get('sewa', [SewaController::class, 'index']);
    Route::put('sewa/{id}', [SewaController::class, 'update']);
    Route::get('selesai_sewa', [SewaController::class, 'count_selesai']);
    Route::get('belum_selesai_sewa', [SewaController::class, 'count_belum_selesai']);
    Route::get('sewa_chart', [SewaController::class, 'sewa_chart']);
});

Route::middleware(['auth:sanctum', 'user'])->group(function () {
    Route::get('sewa_user', [SewaController::class, 'sewa_user']);
    Route::post('sewa', [SewaController::class, 'store']);
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
});

Route::get('detail_barang', [DetailBarangController::class, 'index']); 
Route::get('rental', [RentalController::class, 'index']); 

Route::post('register', [AuthController::class, 'register']); 
Route::post('login', [AuthController::class, 'login']); 
