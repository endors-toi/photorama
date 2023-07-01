@extends('templates.master')

@section('title')
    PHOTORAMA
@endsection

@section('main-content')
<div class="container-fluid">
    <div class="row">
        <div class="col">

        </div>
    </div>
    <div class="row">
        @if($imagenes->isEmpty())
        <div class="col-12 d-flex justify-content-center">
            <h5 style="margin-top:10%">¡Aún no hay imágenes! :( Podrías subir una nueva :)</h5>
        </div>
        @else
        <div class="col">
            @foreach($imagenes as $imagen)
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="{{ asset('storage/' . $imagen->archivo) }}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">{{$imagen->titulo}}</h5>
                    <p class="card-text">Por: {{$imagen->cuentas->nombre}} {{$imagen->cuentas->apellido}}</p>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>    
</div>
@endsection
