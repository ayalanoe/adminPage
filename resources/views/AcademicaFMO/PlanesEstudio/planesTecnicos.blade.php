@extends('Layouts.index') 

@section('titulo-publico', '- Diplomados')

@section('css-publico')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/principal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/cssPublic/PlanesStyle/tecnicos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tituloEncabezadoGlobal.css') }}">
@endsection

@section('contenido-publico')
<div class="container_tablee">
    <h3 id="h">CARRERAS TÉCNICAS</h3>
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
                        @foreach ($carrerasTecnicas as $carTecnica)
                        <a href="{{route('mostrarPDFCarTec', $carTecnica->id)}}" target="_blank" class="item-plan" href="#">
                            {{$carTecnica->carrera}}
                        </a> 
                        @endforeach
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


