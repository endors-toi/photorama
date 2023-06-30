<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UsuariosRequest;
use App\Http\Requests\CambiarContrasenaRequest;
use Illuminate\Support\Facades\Hash;
use Gate;

class UsuariosController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except(['autenticar','logout']);
    }

    // Autenticar usuario
    public function autenticar(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        
        if(Auth::attempt(['email'=>$email,'password'=>$password,'activo'=>true])){
            Auth::user()->registraUltimoLogin();
            return redirect()->route('home.index');
        }

        return back()->withErrors([
            'email' => 'Credenciales Incorrectas',
        ])->onlyInput('email');
    }

    //Cerrar sesión
    public function logout(){
        Auth::logout();
        return redirect()->route('home.login');
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
