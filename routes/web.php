<?php

use App\Http\Controllers\ContasController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\InicioController;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/' , [LoginController::class, 'index'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login.start');

Route::get('/inicio', [InicioController::class, 'index'])->name('inicio');
Route::get('/inicio-report', [InicioController::class, 'report'])->name('inicio.report');


//Rotas para Contas
Route::post('/contas-store', [ContasController::class, 'store'])->name('contas.store');
Route::post('/contas-status', [ContasController::class, 'status'])->name('contas.status');
