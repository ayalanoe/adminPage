@extends('Layouts.index') 

@section('titulo-publico', '- Posgrado')

@section('css-publico')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/styleNav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/cssPublic/PlanesStyle/posgrado.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tituloEncabezadoGlobal.css') }}">
@endsection

@section('contenido-publico')

<div class="container margen-titulo">

    <div class="row justify-content-center mb-4">
        <div class="col-12">
            <h3 class="title-text text-center">CARRERAS DE POSGRADO</h3>
        </div>
    </div>

    <div class="container_table">

        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 d-flex mx-auto">
                    <div class="card flex-fill custom-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="title-container">
                                    <h5 class="card-title">Para ver el plan de estudio, haz click en la carrera</h5>   
                                </div>
                            </div>
                            <hr>
                            @foreach ($planesPosgrado as $carreraPosgrado)
                                <a href="{{route('mostrarPDFPosgrado', $carreraPosgrado->id)}}" target="_blank" class="item-plan" href="#">
                                    {{$carreraPosgrado->carrera}}
                                </a> 
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>       
        </div>

    </div>

</div>

@endsection

@section('jsVistasPublicas')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@endsection


