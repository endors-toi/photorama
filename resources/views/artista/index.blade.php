@extends('templates.master')

@section('title') Artista Dashboard @endsection

@section('hojas-estilo') <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" /> @endsection

@section('main-content')
<div class="row my-5 d-flex justify-content-center">
    <div class="col text-center">
        <h1>Panel del Artista</h1>
    </div>
</div>
<div class="row d-flex justify-content-center">
    {{-- Imagenes --}}
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <img class="card-img-top" src="https://via.placeholder.com/300" alt="Card image cap">
                    <div class="card-body">
                        <a href={{route('artista.create')}} class="btn btn-primary btn-add">
                            <span class="fa fa-plus"> Agregar Imágenes</span>
                        </a>
                    </div>
                </div>
            </div>
            @if($imagenes->isEmpty())
            <div class="col-12 d-flex justify-content-center">
                <h5 style="margin-top:10%">¡Aún no hay imágenes! :( Podrías subir una nueva :)</h5>
            </div>
            @else
            <div class="col d-flex">
                @foreach($imagenes as $imagen)
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="{{ asset('storage/' . $imagen->archivo) }}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">{{$imagen->titulo}}</h5>
                        <p class="card-text">Por: {{$imagen->cuentas->nombre}} {{$imagen->cuentas->apellido}}</p>
                        <div class="flex">
                            <a href={{route('artista.edit')}} class="btn btn-primary btn-add">
                                <span class="fa fa-plus">Editar</span>
                            </a>
                            <a href={{route('artista.destroy')}} class="btn btn-primary btn-add">
                                <span class="fa fa-plus">Borrar</span>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
