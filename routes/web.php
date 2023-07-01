<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CuentasController;
use App\Http\Controllers\ImagenesController;

// Ruta para el Home
Route::get('/',[HomeController::class,'index'])->name('home.index')->middleware('web');
Route::get('/login',[HomeController::class,'login'])->name('home.login');
Route::get('/filtro',[HomeController::class,'indexFiltrado'])->name('home.filtro');

// Rutas de autenticación
Route::post('/login',[CuentasController::class,'autenticar'])->name('cuentas.autenticar');
Route::get('/logout',[CuentasController::class,'logout'])->name('cuentas.logout');
Route::get('/register',[CuentasController::class,'create'])->name('cuentas.create');

// Rutas para el Admin
Route::get('/admin', [CuentasController::class, 'index'])->name('admin.index');
Route::post('/admin/artistas', [CuentasController::class, 'store'])->name('admin.store');
Route::get('/admin/artistas/{cuenta}/edit', [CuentasController::class, 'edit'])->name('admin.edit');
Route::put('/admin/artistas/{cuenta}', [CuentasController::class, 'update'])->name('admin.update');
Route::delete('/admin/artistas/{cuenta}', [CuentasController::class, 'destroy'])->name('admin.destroy');

//Rutas para el Artista
Route::get('/artista', [CuentasController::class, 'indexArtista'])->name('artista.index');
Route::get('/artista/imagenes/create', [CuentasController::class, 'createArtista'])->name('artista.create');
Route::post('/artista/imagenes', [CuentasController::class, 'storeArtista'])->name('artista.store');
Route::get('/artista/imagenes/{id}/edit', [CuentasController::class, 'editArtista'])->name('artista.edit');
Route::put('/artista/imagenes/{id}', [CuentasController::class, 'updateArtista'])->name('artista.update');
Route::delete('/artista/imagenes/{id}', [CuentasController::class, 'destroyArtista'])->name('artista.destroy');

// IMG
Route::put('/imagen/{id}/ban', [ImagenesController::class, 'ban'])->name('imagenes.ban');
Route::put('/imagen/{id}/desban', [ImagenesController::class, 'desban'])->name('imagenes.desban');
Route::delete('/imagen/{id}/destroy', [ImagenesController::class, 'destroy'])->name('imagenes.destroy');
