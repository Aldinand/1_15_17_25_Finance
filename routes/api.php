<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\KategoriController;

Route::middleware('auth:api')->prefix('kategoris')->group(function () {
    Route::get('/', [KategoriController::class, 'index']);         // GET /api/kategoris
    Route::post('/', [KategoriController::class, 'store']);        // POST /api/kategoris
    Route::get('{id}', [KategoriController::class, 'show']);       // GET /api/kategoris/{id}
    Route::put('{id}', [KategoriController::class, 'update']);     // PUT /api/kategoris/{id}
    Route::delete('{id}', [KategoriController::class, 'destroy']); // DELETE /api/kategoris/{id}
});


Route::get('/transaksi', [TransaksiController::class, 'index']);  // Untuk mengambil semua transaksi
Route::post('/transaksi', [TransaksiController::class, 'store']); // Untuk membuat transaksi baru
Route::get('/transaksi/{id}', [TransaksiController::class, 'show']); // Untuk menampilkan detail transaksi berdasarkan ID
Route::put('/transaksi/{id}', [TransaksiController::class, 'update']); // Untuk memperbarui transaksi berdasarkan ID
Route::delete('/transaksi/{id}', [TransaksiController::class, 'destroy']); // Untuk menghapus transaksi berdasarkan ID


Route::group([], function () {
    Route::get('category', [CategoryController::class, 'listCategory']);
});

