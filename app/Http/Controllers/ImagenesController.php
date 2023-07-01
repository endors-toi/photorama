<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Imagen;
use Gate;

class ImagenesController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function ban($id, Request $request)
    {
        if(Gate::denies('es_Admin')){
            return redirect()->route('home.index');
        }
        $imagen = Imagen::find($id);
        $imagen->baneada = true;
        $imagen->motivo_ban = $request->motivo;
        $imagen->save();
        return redirect()->route('admin.index');
    }

    public function desban($id)
    {
        if(Gate::denies('es_Admin')){
            return redirect()->route('home.index');
        }
        $imagen = Imagen::find($id);
        $imagen->baneada = false;
        $imagen->motivo_ban = null;
        $imagen->save();
        return redirect()->route('admin.index');
    }

    public function destroy($id)
    {
        if(Gate::denies('es_Admin')){
            return redirect()->route('home.index');
        }
        $imagen = Imagen::find($id);
        File::delete($imagen->archivo);
        $imagen->delete();
        return redirect()->route('admin.index');
    }
}
