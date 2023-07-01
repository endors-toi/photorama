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
<div class="col">
    <div class="card">
        <div class="card-header bg-dark text-white">Ingrese los datos</div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.store') }}">
                @csrf
                {{-- Usuario --}}
                <div class="mb-3">
                    <label for="user" class="form-label">Usuario</label>
                    <input type="text" id="user" name="user" class="form-control">
                </div>
            
                {{-- Nombre --}}
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" id="nombre" name="nombre" class="form-control">
                </div>
            
                {{-- Apellido --}}
                <div class="mb-3">
                    <label for="apellido" class="form-label">Apellido</label>
                    <input type="text" id="apellido" name="apellido" class="form-control">
                </div>
            
                {{-- Contraseña --}}
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" id="password" name="password" class="form-control">
                </div>

                {{-- Contraseña --}}
                <div class="mb-3">
                    <label for="password2" class="form-label">Repita la contraseña</label>
                    <input type="password" id="password2" name="password2" class="form-control">
                </div>
            
                {{-- Perfil ID (campo oculto) --}}
                <input type="hidden" name="perfil" value={{ 2 }}>
            
                {{-- Botones --}}
                <div class="mb-3 d-grid gap-2 d-lg-block">
                    <button class="btn btn-warning" type="reset">Cancelar</button>
                    <button class="btn btn-success" type="submit">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

      </div>
    </div>
</div>
@endsection