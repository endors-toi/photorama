@extends('templates.master')

@section('title') Admin Dashboard @endsection

@section('hojas-estilo') <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" /> @endsection

@section('main-content')
<div class="row my-5 d-flex justify-content-center">
    <div class="col text-center">
        <h1>Panel del Administrador</h1>
    </div>
</div>
<div class="row d-flex justify-content-center">
    {{-- Perfiles --}}
    <div class="col-6 mb-5">
        <h3>Perfiles</h3>
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Nombre</th>
                </tr>
            </thead>
            <tbody>
                @foreach($perfiles as $perfil)
                <tr>
                    <td class="align-middle">{{$perfil->id}}</td>
                    <td class="align-middle">{{$perfil->nombre}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{-- Cuentas --}}
    <div class="col-6 mb-5">
        <h3>Cuentas</h3>
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>User</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Tipo de perfil</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cuentas as $index => $cuenta)
                <tr>
                    <td class="align-middle">{{$index+1}}</td>
                    <td class="align-middle">{{$cuenta->user}}</td>
                    <td class="align-middle">{{$cuenta->nombre}}</td>
                    <td class="align-middle">{{$cuenta->apellido}}</td>
                    <td class="align-middle">{{$cuenta->perfiles->nombre}}</td>
                    <td>
                        <div class="row">
                            {{-- borrar --}}
                            @if($cuenta->user != Auth::user()->user)
                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#borrarModal{{$cuenta->user}}">
                                Borrar
                            </button>
                            @endif

                            <!-- Modal -->
                            <div class="modal fade" id="borrarModal{{$cuenta->user}}" tabindex="-1" role="dialog" aria-labelledby="borrarModalLabel{{$cuenta->user}}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="borrarModalLabel{{$cuenta->user}}">Confirmar Eliminar</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form method="POST" action="{{route('admin.destroy',$cuenta->user)}}">
                                            @method('delete')
                                            @csrf
                                            <div class="modal-body">
                                                <p>¿Desea eliminar a {{$cuenta->nombre}} del sistema?</p>
                                                <h5>¡Esta accion es permanente!</h5>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <span class="material-symbols-outlined">Borrar</span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            {{-- editar --}}
                            <div class="col">
                                <a href="{{route('admin.edit',['cuenta'=>$cuenta])}}" class="btn btn-sm btn-warning pb-0 text-white" data-bs-toggle="tooltip" data-bs-title="Editar profesor">
                                    <span class="material-symbols-outlined">Editar</span>
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <form action="{{route('cuentas.create')}}" method="GET">
            @csrf
            <button class="btn btn-secondary" type="submit">Agregar Cuenta de artista</button>
        </form>
    </div>
    {{-- Imagenes --}}
    <div class="col">
        @if($imagenes->isEmpty())
        <div class="col-12 d-flex justify-content-center">
            <h5 style="margin-top:10%">¡Aún no hay imágenes! Invita artistas :P</h5>
        </div>
        @else
        <div class="col">
            @foreach($imagenes as $imagen)
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="{{asset($imagen->archivo)}}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">{{$imagen->titulo}}</h5>
                    @if($imagen->baneada)
                    <form method="POST" action="{{route('imagenes.desban', $imagen->id)}}">
                        @csrf
                        @method('put')
                        <button class="btn btn-warning"type="submit">DESBAN</button>
                    </form>
                    @else
                    <form method="POST" action="{{route('imagenes.ban', $imagen->id)}}">
                        @csrf
                        @method('put')
                        <input class="form-control" type="text" id="motivo" name="motivo" placeholder="Motivo de Ban">
                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#banModal{{$imagen->id}}">
                            BAN
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="banModal{{$imagen->id}}" tabindex="-1" role="dialog" aria-labelledby="banModalLabel{{$imagen->id}}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="banModalLabel{{$imagen->id}}">Confirmar Ban</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="POST" action="{{route('imagenes.ban',$imagen->id)}}">
                                        @method('put')
                                        @csrf
                                        <div class="modal-body">
                                            <p>¿Confirma banear esta imagen?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <span class="material-symbols-outlined">BANEAR</span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </form>
                    @endif
                    <p class="card-text">Por: {{$imagen->cuentas->nombre}} {{$imagen->cuentas->apellido}}</p>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>
@endsection
