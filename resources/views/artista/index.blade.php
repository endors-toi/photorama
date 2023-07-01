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
                        <button class="btn btn-primary btn-add" data-toggle="modal" data-target="#addImageModal">
                            <span class="fa fa-plus"> Agregar Imágenes</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
