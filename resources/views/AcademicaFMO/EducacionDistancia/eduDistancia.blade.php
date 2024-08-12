@extends('Layouts.index') 

@section('titulo-publico', '- Educación a distancia')

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
            <h3 class="title-text text-center">INFORMACIÓN SOBRE CARRERAS A DISTANCIA</h3>
        </div>
    </div>

    <div class="container_table">

        @if ($eduDisOtraFacultad->isEmpty())
            <div class="alert alert-success text-center">
                No hay registro
            </div>

            <br><br><br><br><br><br>
        @else

            <div class="row">
                @foreach ($eduDisOtraFacultad as $carDistancia)
                    <div class="col-12 col-md-6 d-flex">
                        
                        <div class="card flex-fill custom-card ">
                        
                            <img src="{{ asset('storage/'.$carDistancia->rutaBanner) }}" class="card-img-top" alt="...">
                            <div class="card-body">
                            <h5 class="card-title"> {{$carDistancia->carrera}} </h5>
                            <p class="card-text">Se les invita a descargar:</p>
                            <a href="{{ route('publicVerPdfCarDis', $carDistancia->id)}}" target="_blank" class="btn btn-ver">Leer más</a>
                            </div>
                        </div>
                    </div>
            
                @endforeach
            </div>

        @endif
    </div>

</div>

@endsection