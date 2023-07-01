@extends('templates.master')
@section('title') Editar Cuenta @endsection
@section('main-content')
<div class="container" style="margin-top: 20%">
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
            <form method="POST" action="{{route('admin.update',['cuenta'=>$cuenta])}}">
                @csrf
                @method('PUT')
                {{-- nombre --}}
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" id="nombre" name="nombre" class="form-control">
                </div>
                {{-- apellido --}}
                <div class="mb-3">
                    <label for="apellido" class="form-label">Apellido</label>
                    <input type="text" id="apellido" name="apellido" class="form-control">
                </div>
                {{-- botones --}}
                <div class="mb-3 d-grid gap-2 d-lg-block">
                    <button class="btn btn-warning" type="reset">Cancelar</button>
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