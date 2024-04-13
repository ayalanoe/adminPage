@extends('Layouts.index') 

@section('titulo-publico', '- Educación a Distancia FMO')

@section('css-publico')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/principal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/eduDistanciaPublic.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tituloEncabezadoGlobal.css') }}">
    
@endsection

@section('contenido-publico')

    <div class="container">
        <h3>CARRERAS DE EDUCACIÓN A DISTANCIA EN FMO</h3>
        <i class="fa-solid fa-chevron-down fa-3x"></i>
    </div>


    <div class="container">
        <!-- contenedor de tarjetas de plataformas-->
        <!-- Como lo intentabamos <img src="#asset($carDistancia->rutaBanner)}}" class="card-img-top" alt="..."> -->
        <div class="row">

            
            
        </div>
    </div>
@endsection