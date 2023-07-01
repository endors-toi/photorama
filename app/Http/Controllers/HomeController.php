<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Imagen;

class HomeController extends Controller
{
    public function index(){
        $imagenes = Imagen::all();
        return view('home.index', compact('imagenes'));
    }

    public function login(){
        return view('home.login');
    }
}
