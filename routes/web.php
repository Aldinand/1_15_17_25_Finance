<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API;


Route::get('/login', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('register');
});