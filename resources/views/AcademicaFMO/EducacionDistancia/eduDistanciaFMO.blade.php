@extends('Layouts.index') 

@section('titulo-publico', '- Educación a Distancia FMO')

@section('css-publico')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/styleNav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/eduDistanciaPublic.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tituloEncabezadoGlobal.css') }}">
    
@endsection

@section('contenido-publico')

    <div class="container margen-titulo">

        <div class="row justify-content-center mb-4">
            <div class="col-12">
                <h3 class="title-text text-center">CARRERAS DE EDUCACIÓN A DISTANCIA EN LA FMO</h3>
            </div>
        </div>

        <div class="container_table">

            @if ($distanciaFMO->isEmpty())
                <div class="alert alert-success text-center">
                    No hay registro
                </div>
                <br><br><br><br><br>
            @else

                <div class="row">
                    @foreach ($distanciaFMO as $carDistancia)

                        <div class="col-12 col-md-6 d-flex">
                            <div class="card flex-fill custom-card">
                                <img src="{{ asset('storage/'.$carDistancia->rutaBanner) }}" class="card-img-top" alt="...">
                                <div class="card-body">
                                <h5 class="card-title"> {{$carDistancia->carrera}} </h5>
                                <p class="card-text">Para mayor información:</p>
                                <a href="{{ route('infoDistanciaFMO', $carDistancia->id)}}" class="btn btn-ver">Ver aquí</a>
                                </div>
                            </div>
                        </div>
                        
                    @endforeach
                </div>

            @endif

        </div>

    </div>

@endsection