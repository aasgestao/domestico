<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\InicioController;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/' , [LoginController::class, 'index'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login.start');

Route::get('/inicio', [InicioController::class, 'index'])->name('inicio');
