<?php

namespace App\Http\Controllers;

use App\Models\Cuenta;
use App\Models\Perfil;
use App\Models\Imagen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CuentasRequest;
use App\Http\Requests\EditarCuentaRequest;
use App\Http\Requests\ImagenesRequest;
use App\Http\Requests\EditarImagenRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Gate;

class CuentasController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except(['autenticar','logout', 'create']);
    }

    // Autenticar usuario
    public function autenticar(Request $request)
    {
        $user = $request->user;
        $password = $request->password;

        if (Auth::attempt(['user' => $user, 'password' => $password])) {
            if (Gate::allows('es_Admin')) {
                return redirect()->route('admin.index');
            } else {
                return redirect()->route('artista.index');
            }
        }

        return back()->withErrors([
            'user' => 'Usuario o contraseña incorrectos.',
        ])->onlyInput('user');
    }


    //Cerrar sesión
    public function logout(){
        Auth::logout();
        return redirect()->route('home.login');
    }

    //Display a listing of the resource.
    public function index()
    {
        if (Gate::allows('es_Admin')) {
            $perfiles = Perfil::orderBy('nombre')->get();
            $cuentas = Cuenta::orderBy('user')->get();
            $imagenes = Imagen::all();
            return view('admin.index', compact('cuentas', 'perfiles', 'imagenes'));
        } else {
            return redirect()->route('artista.index');
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('home.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CuentasRequest $request)
    {
        $cuenta = new Cuenta();
        $cuenta->user = $request->user;
        $cuenta->nombre = $request->nombre;
        $cuenta->apellido = $request->apellido;
        $cuenta->password = Hash::make($request->password);
        $cuenta->perfil_id = $request->perfil;
        $cuenta->save();
        return redirect()->route('admin.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cuenta $cuenta)
    {
        if(Gate::denies('es_Admin')){
            return redirect()->route('home.index');
        }
        return view('admin.edit', compact('cuenta'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditarCuentaRequest $request, Cuenta $cuenta)
    {
        if (Gate::denies('es_Admin')) {
            return redirect()->route('home.index');
        }
        $cuenta->nombre = $request->nombre;
        $cuenta->apellido = $request->apellido;
        $cuenta->save();
        return redirect()->route('admin.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cuenta $cuenta)
    {
        if (Gate::denies('es_Admin')) {
            return redirect()->route('home.index');
        }

        if ($cuenta->user != Auth::user()->user) {
            $cuenta->delete();
        }

        return redirect()->route('admin.index');
    }

    //Artista
    //Display a listing of the resource.
    public function indexArtista(Cuenta $cuenta)
    {
        // Accede a las imágenes asociadas a la cuenta
        if(Gate::denies('es_Admin')){
            $cuenta = Auth::user()->user;
            $imagenes = Imagen::where('cuenta_user', $cuenta)->get();

            return view('artista.index', compact('imagenes'));
        }
        return redirect()->route('admin.index');
        
    }

    public function createArtista()
    {
        if(Gate::denies('es_Admin')){
            return view('artista.create');
        }
        return redirect()->route('admin.index');
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeArtista(ImagenesRequest $request)
    {
        $archivo = $request->file('archivo');
        $user = $request->input('cuenta_user');
        $pathCarpeta = 'public/' . $user;
        $nombreArchivo = $archivo->getClientOriginalName();
        $pathArchivo = $archivo->storeAs($pathCarpeta, $nombreArchivo, 'local');

        $imagen = new Imagen;
        $imagen->titulo = $request->input('titulo');
        $imagen->baneada = $request->input('baneada') ?? false;
        $imagen->motivo_ban = $request->input('motivo_ban') ?? null;
        $imagen->cuenta_user = $user;
        $imagen->archivo = 'storage/' . $user . '/' . $nombreArchivo;
        $imagen->save();

        return redirect()->route('artista.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editArtista($id)
    {   
        if(Gate::denies('es_Admin')){
            $imagen = Imagen::find($id);
            return view('artista.edit', compact('imagen'));
        }
        return redirect()->route('admin.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateArtista(EditarImagenRequest $request, $id)
    {
        if(Gate::denies('es_Admin')){
            $imagen = Imagen::find($id);
            $imagen->titulo = $request->titulo;
            $imagen->save();

            return redirect()->route('artista.index');
        }
        return redirect()->route('admin.index');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyArtista(Imagen $imagen)
    {
        if(Gate::denies('es_Admin')){
            if ($cuenta->user != Auth::user()->user) {
                $cuenta->delete();
            }
    
            return redirect()->route('artista.index');
        }
        return redirect()->route('admin.index');
        
    }
}
