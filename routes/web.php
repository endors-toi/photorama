<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CuentasController;
use App\Http\Controllers\ImagenesController;

// Ruta para el home
Route::get('/',[HomeController::class,'index'])->name('home.index')->middleware('web');
Route::get('/login',[HomeController::class,'login'])->name('home.login');

// Rutas de autenticación
Route::post('/cuentas/login',[CuentasController::class,'autenticar'])->name('cuentas.autenticar');
Route::get('/logout',[CuentasController::class,'logout'])->name('cuentas.logout');

// Ruta para el Admin DashBoard
Route::get('/dashboard',function(){return view('admin.dashboard');});
