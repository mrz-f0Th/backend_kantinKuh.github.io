<?php

use App\Http\Controllers\KeranjangDetailController;
use App\Http\Controllers\KeranjangsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PesanansController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TransaksiController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('produk', [ProdukController::class, 'index']);
Route::get('produk/{id}', [ProdukController::class, 'show']);
Route::post('produk', [ProdukController::class, 'store'])->middleware('auth:sanctum');
Route::delete('produk/{id}', [ProdukController::class, 'destroy'])->middleware('auth:sanctum');
Route::post('produk-edit/{id}', [ProdukController::class, 'update'])->middleware('auth:sanctum');

Route::get('keranjangs', [KeranjangsController::class, 'index']);
Route::post('keranjangs', [KeranjangsController::class, 'store']);
Route::delete('keranjangs/{id}', [KeranjangsController::class, 'destroy']);

Route::get('keranjangdetail', [KeranjangDetailController::class, 'index']);
Route::post('keranjangdetail', [KeranjangDetailController::class, 'store']);
Route::delete('keranjangdetail/{id}', [KeranjangDetailController::class, 'destroy']);

Route::get('transaksi', [TransaksiController::class, 'index']);
Route::post('transaksi', [TransaksiController::class, 'store']);
Route::delete('transaksi', [TransaksiController::class, 'destroy']);

Route::resource('pesanan', TransaksiController::class)->except(['create', 'edit']);

Route::post('login', [LoginController::class, 'login']);
Route::delete('logout', [LoginController::class, 'logout']);
