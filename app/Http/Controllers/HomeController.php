<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Imagen;
use App\Models\Cuenta;

class HomeController extends Controller
{
    public function index(){
        $imagenes = Imagen::all();
        $artistas = Cuenta::where('perfil_id', 2)->get();
        return view('home.index', compact('imagenes', 'artistas'));
    }

    public function indexFiltrado(Request $request){
        $user = $request->artista;
        $imagenes = Imagen::where('cuenta_user', $user)->get();
        $artistas = Cuenta::where('perfil_id', 2)->get();
        return view('home.index', compact('imagenes', 'artistas'));
    }

    public function login(){
        return view('home.login');
    }
}
