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
                <a href={{route('artista.create')}} class="btn btn-primary btn-add">
                    <span class="fa fa-plus">Agregar Imágenes</span>
                </a>
            </div>
            @if($imagenes->isEmpty())
            <div class="col-12 d-flex justify-content-center">
                <h5 style="margin-top:10%">¡Aún no tienes imágenes! :(</h5>
            </div>
            @else
            <div class="col d-flex">
                @foreach($imagenes as $imagen)
                <div class="card" style="width: 18rem; @if($imagen->baneada) background-color:lightpink @endif">
                    <img class="card-img-top" src="{{asset($imagen->archivo)}}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">{{$imagen->titulo}} @if($imagen->baneada) (BANEADA) @endif </h5>
                        @if($imagen->baneada) <p class="card-text">Motivo Ban: {{$imagen->motivo_ban}}</p> @endif
                        <div class="flex">
                            <a href="{{route('artista.edit', ['id'=>$imagen->id])}}" class="btn btn-primary btn-add">
                                <span class="fa fa-plus">Editar</span>
                            </a>
                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#borrarModal{{$imagen->id}}">
                                Borrar
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="borrarModal{{$imagen->id}}" tabindex="-1" role="dialog" aria-labelledby="borrarModalLabel{{$imagen->id}}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="borrarModalLabel{{$imagen->id}}">Confirmar Eliminar</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form method="POST" action="{{route('imagenes.destroy',$imagen->id)}}">
                                            @method('delete')
                                            @csrf
                                            <div class="modal-body">
                                                <p>¿Desea eliminar esta imagen?</p>
                                                <h5>¡Esta accion es permanente!</h5>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <span class="material-symbols-outlined">Confirmar Borrado</span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
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
