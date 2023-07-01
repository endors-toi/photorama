@extends('templates.master')
@section('title') Editar Imagen @endsection
@section('main-content')
<div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-4 col-md-6">
        @if($errors->any())
            <div class="alert alert-warning">
                @foreach ($errors->all() as $error)
                {{ $error }}
                @endforeach
            </div>
        @endif
        {{-- formulario --}}
            <div class="col">
                <div class="card">
                    <div class="card-header bg-dark text-white">Ingrese los nuevos datos</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('artista.update', $imagen->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="titulo" class="form-label">Titulo</label>
                                <input type="text" id="titulo" name="titulo" class="form-control" placeholder="{{$imagen->titulo}}">
                            </div>

                            {{-- botones --}}
                            <div class="mb-3 d-grid gap-2 d-lg-block">
                                <a href="{{route('artista.index')}}" class="btn btn-warning">Atras</a>
                                <button class="btn btn-success" type="submit">Actualizar</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
      </div>
    </div>
</div>
@endsection
