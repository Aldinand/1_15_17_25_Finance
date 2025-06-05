<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\UserSwaggerController;
use App\Http\Controllers\API\AnggaranSwaggerController;
use App\Http\Controllers\API\KategoriSwaggerController;
use App\Http\Controllers\API\TransaksiSwaggerController;
use App\Http\Controllers\API\LaporanKeuanganSwaggerController;
use App\Http\Controllers\API\AuthController;


// Kategori
Route::get('kategoris', [KategoriSwaggerController::class, 'index']);
Route::post('kategoris', [KategoriSwaggerController::class, 'store']);
Route::get('kategoris/{id}', [KategoriSwaggerController::class, 'show']);
Route::put('kategoris/{id}', [KategoriSwaggerController::class, 'update']);
Route::delete('kategoris/{id}', [KategoriSwaggerController::class, 'destroy']);

// Anggaran
Route::get('anggaran', [AnggaranSwaggerController::class, 'index']);
Route::post('anggaran', [AnggaranSwaggerController::class, 'store']);
Route::get('anggaran/{id}', [AnggaranSwaggerController::class, 'show']);
Route::put('anggaran/{id}', [AnggaranSwaggerController::class, 'update']);
Route::delete('anggaran/{id}', [AnggaranSwaggerController::class, 'destroy']);
Route::get('anggaran/user/{user_id}', [AnggaranSwaggerController::class, 'getByUserId']);

// User
Route::get('users', [UserSwaggerController::class, 'index']);
Route::post('users', [UserSwaggerController::class, 'store']);
Route::get('users/{id}', [UserSwaggerController::class, 'show']);
Route::put('users/{id}', [UserSwaggerController::class, 'update']);
Route::delete('users/{id}', [UserSwaggerController::class, 'destroy']);

// Transaksi
Route::get('transaksi', [TransaksiSwaggerController::class, 'index']);
Route::post('transaksi', [TransaksiSwaggerController::class, 'store']);
Route::get('transaksi/{id}', [TransaksiSwaggerController::class, 'show']);
Route::put('transaksi/{id}', [TransaksiSwaggerController::class, 'update']);
Route::delete('transaksi/{id}', [TransaksiSwaggerController::class, 'destroy']);
Route::get('/transaksi/user/{user_id}', [TransaksiSwaggerController::class, 'getByUser']);


// Laporan Keuangan
Route::get('laporan-keuangans', [LaporanKeuanganSwaggerController::class, 'index']);
Route::post('laporan-keuangans', [LaporanKeuanganSwaggerController::class, 'store']);
Route::get('laporan-keuangans/{id}', [LaporanKeuanganSwaggerController::class, 'show']);
Route::put('laporan-keuangans/{id}', [LaporanKeuanganSwaggerController::class, 'update']);
Route::delete('laporan-keuangans/{id}', [LaporanKeuanganSwaggerController::class, 'destroy']);
Route::get('laporan-keuangans/user/{user_id}', [LaporanKeuanganSwaggerController::class, 'getByUser']);

// Auth
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// Contoh route yang butuh auth
Route::middleware('auth:sanctum')->group(function () {
    Route::get('profile', [AuthController::class, 'profile']);
    // Tambahkan route lain yang ingin diamankan di sini
});
