@extends('templates.master')

@section('title')
    PHOTORAMA
@endsection

@section('main-content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <form method="GET" action="{{route('home.filtro')}}">
                @csrf
                <select id="artista" name="artista" class="form-control">
                    @foreach($artistas as $artista)
                    <option value="{{$artista->user}}">{{$artista->nombre}} {{$artista->apellido}}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-success">Filtrar</button>
            </form>
        </div>
    </div>
    <div class="row">
        @if($imagenes->isEmpty())
        <div class="col-12 d-flex justify-content-center">
            <h5 style="margin-top:10%">¡Aún no hay imágenes! :( Podrías subir una nueva :)</h5>
        </div>
        @else
        <div class="col d-flex">
            @foreach($imagenes as $imagen)
                @if($imagen->baneada == false)
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="{{asset($imagen->archivo)}}" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">{{$imagen->titulo}}</h5>
                            <p class="card-text">Por: {{$imagen->cuentas->nombre}} {{$imagen->cuentas->apellido}}</p>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        @endif
    </div>
</div>
@endsection
