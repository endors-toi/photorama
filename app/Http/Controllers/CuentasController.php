<?php

namespace App\Http\Controllers;

use App\Models\Cuenta;
use App\Models\Perfil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CuentasRequest;
use App\Http\Requests\CambiarContrasenaRequest;
use Illuminate\Support\Facades\Hash;
use Gate;

class CuentasController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except(['autenticar','logout']);
    }

    // Autenticar usuario
    public function autenticar(Request $request)
    {
        $user = $request->user;
        $password = $request->password;

        if(Auth::attempt(['user'=>$user,'password'=>$password])){
            return redirect()->route('home.index');
        }

        return back()->withErrors([
            'user' => 'Usuario o contraseña incorrectos.',
        ])->onlyInput('user');
    }

    //Cerrar sesión
    public function logout(){
        Auth::logout();
        return redirect()->route('home.index');
    }

    //Display a listing of the resource.
    public function index()
    {
        if(Gate::denies('es_Admin')){
            return redirect()->route('home.index');
        }

        $perfiles = Perfil::orderBy('nombre')->get();
        $usuarios = Usuario::orderBy('nombre')->get();
        return view('usuarios.index',compact(['usuarios','perfiles']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return redirect()->route('usuarios.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UsuariosRequest $request)
    {
        $usuario = new Usuario();
        $usuario->nombre = $request->nombre;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->password);
        $usuario->perfil_id = $request->perfil;
        $usuario->save();
        return redirect()->route('usuarios.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Usuario $usuario)
    {
        $usuario = Usuario::findOrFail($id);
        return view('mostrar un usuario en especifico', compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Usuario $usuario)
    {
        if(Gate::denies('es_Admin')){
            return redirect()->route('home.index');
        }
        return redirect()->route('usuarios.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UsuariosRequest $request, $id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->nombre = $request->nombre;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->password);
        $usuario->perfil_id = $request->perfil;
        $usuario->save();
        return redirect()->route('usuarios.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Usuario $usuario)
    {
        if(Gate::denies('es_Admin')){
            return redirect()->route('home.index');
        }

        if($usuario!=Auth::user()){
            $usuario->delete();
        }

        return redirect()->route('usuarios.index');
    }
}
