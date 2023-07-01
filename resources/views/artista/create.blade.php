@extends('templates.master')
@section('title') Register @endsection
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
            <div class="row">
                <div class="col">
                    <h2>Subir una Nueva Imagen</h2>
                    <form action="{{ route('artista.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="titulo">Título</label>
                            <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Ingrese el título">
                        </div>
                        <div class="form-group">
                            <label for="archivo">Archivo</label>
                            <input type="file" class="form-control-file" id="archivo" name="archivo">
                        </div>
                        <input type="hidden" name="baneada" value="0">
                        <input type="hidden" name="motivo_ban" value="">
                        <input type="hidden" name="cuenta_user" value="{{ auth()->user()->user }}">

                        <button type="submit" class="btn btn-primary">Subir Imagen</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection