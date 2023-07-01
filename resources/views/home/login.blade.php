@extends('templates.master')
@section('title') LOGIN @endsection
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
        <form method="POST" action="{{route('cuentas.autenticar')}}">
            @csrf
            <h2 class="text-center mb-4">Bienvenido!</h2>
            <div class="form-group">
                <label for="user">Nombre de Usuario</label>
                <input type="text" class="form-control" id="user" name="user" placeholder="Ingresa tu usuario" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Ingresa tu contraseña" required>
            </div>
            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary">Entrar</button>
                <a class="btn btn-primary" role="button" href="{{route('home.index')}}">Volver</a>
            </div>
        </form>
      </div>
    </div>
</div>
@endsection