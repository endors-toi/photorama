<?php

use Illuminate\Support\Facades\Route;

// Ruta para el home
Route::get('/',function(){return view('home.index');});

//Ruta para el DashBoard del admin
Route::get('/dashboard',function(){return 'Admin dashboard';});