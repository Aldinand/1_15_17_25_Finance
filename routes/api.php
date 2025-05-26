<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\AnggaranController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\API\UserSwaggerController;
use App\Http\Controllers\API\AnggaranSwaggerController;
use App\Http\Controllers\API\KategoriSwaggerController;
use App\Http\Controllers\API\TransaksiSwaggerController;
use App\Http\Controllers\API\LaporanSwaggerController;
use App\Http\Controllers\LaporanKeuanganController;

Route::group([], function () {
    // Kategori
    Route::get('kategoris', [KategoriSwaggerController::class, 'index']);
    Route::post('kategoris', [KategoriSwaggerController::class, 'store']);
    Route::get('kategoris/{id}', [KategoriSwaggerController::class, 'show']);
    Route::put('kategoris/{id}', [KategoriSwaggerController::class, 'update']);
    Route::delete('kategoris/{id}', [KategoriSwaggerController::class, 'destroy']);

    // Anggaran
    Route::get('anggarans', [AnggaranController::class, 'index']);
Route::post('anggarans', [AnggaranController::class, 'store']);
Route::get('anggarans/{id}', [AnggaranController::class, 'show']);
Route::put('anggarans/{id}', [AnggaranController::class, 'update']);
Route::delete('anggarans/{id}', [AnggaranController::class, 'destroy']);


    // User
    Route::get('users', [UserController::class, 'index']);
    Route::post('users', [UserController::class, 'store']);
    Route::get('users/{id}', [UserController::class, 'show']);
    Route::put('users/{id}', [UserController::class, 'update']);
    Route::delete('users/{id}', [UserController::class, 'destroy']);

    // Transaksi
    Route::get('transaksis', [TransaksiController::class, 'index']);
    Route::post('transaksis', [TransaksiController::class, 'store']);
    Route::get('transaksis/{id}', [TransaksiController::class, 'show']);
    Route::put('transaksis/{id}', [TransaksiController::class, 'update']);
    Route::delete('transaksis/{id}', [TransaksiController::class, 'destroy']);

    // Laporan Keuangan
    Route::get('laporan-keuangans', [LaporanKeuanganController::class, 'index']);
    Route::post('laporan-keuangans', [LaporanKeuanganController::class, 'store']);
    Route::get('laporan-keuangans/{id}', [LaporanKeuanganController::class, 'show']);
    Route::put('laporan-keuangans/{id}', [LaporanKeuanganController::class, 'update']);
    Route::delete('laporan-keuangans/{id}', [LaporanKeuanganController::class, 'destroy']);

    Route::get('kategoris', [KategoriSwaggerController::class, 'index']);         // GET all categories
    Route::post('kategoris', [KategoriSwaggerController::class, 'store']);        // POST create new category
    Route::get('kategoris/{id}', [KategoriSwaggerController::class, 'show']);     // GET category by id
    Route::put('kategoris/{id}', [KategoriSwaggerController::class, 'update']);   // PUT update category
    Route::delete('kategoris/{id}', [KategoriSwaggerController::class, 'destroy']);// DELETE category
});

Route::apiResource('laporan-keuangan', LaporanKeuanganController::class);

Route::group([], function () {
    Route::get('category', [KategoriController::class, 'listCategory']);
});

Route::get('/kategoris', [KategoriController::class, 'index']);        // Get all categories
Route::post('/kategoris', [KategoriController::class, 'store']);       // Create new category
Route::get('/kategoris/{id}', [KategoriController::class, 'show']);    // Get category by ID
Route::put('/kategoris/{id}', [KategoriController::class, 'update']);  // Update category by ID
Route::delete('/kategoris/{id}', [KategoriController::class, 'destroy']); // Delete category by ID


    Route::get('/transaksi', [TransaksiController::class, 'index']);
    Route::post('/transaksi', [TransaksiController::class, 'store']);
    Route::get('/transaksi/{id}', [TransaksiController::class, 'show']);
    Route::put('/transaksi/{id}', [TransaksiController::class, 'update']);
    Route::delete('/transaksi/{id}', [TransaksiController::class, 'destroy']);

Route::get('/kategoris', [KategoriController::class, 'index']);        // Get all categories
Route::post('/kategoris', [KategoriController::class, 'store']);       // Create new category
Route::get('/kategoris/{id}', [KategoriController::class, 'show']);    // Get category by ID
Route::put('/kategoris/{id}', [KategoriController::class, 'update']);  // Update category by ID
Route::delete('/kategoris/{id}', [KategoriController::class, 'destroy']);


Route::get('users', [UserController::class, 'index']);
Route::post('users', [UserController::class, 'store']);
Route::get('users/{id}', [UserController::class, 'show']);
Route::put('users/{id}', [UserController::class, 'update']);
Route::delete('users/{id}', [UserController::class, 'destroy']);
