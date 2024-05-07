@extends('Layouts.index') 

@section('titulo-publico', '- Tipos de Ingreso')

@section('css-publico')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/principal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tramitesPublic.css') }}">
@endsection

@section('contenido-publico')
<div class="container_table">

    @if ($tiposDeIngreso->isEmpty())
        <div class="container">

            <h3>TIPOS DE INGRESO</h3>
            <hr>
            <div class="alert alert-success">
                No hay registro
            </div>

        </div>
    @else

        <div class="container">

            <h3> TIPOS DE INGRESO </h3>
            <hr>

            <div class="row">

                @foreach ($tiposDeIngreso as $ingreso)
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{$ingreso->titulo}}</h5>
                                <p class="card-text">{!! $ingreso->descripcion !!}</p>
                                <a href="{{route('verInfoTiposIngreso', $ingreso->id)}}" class="btn btn-primary">Ir a la información</a>
                            </div>
                        </div>
                    </div>
                @endforeach
                
            </div>

        </div>
        
    @endif

    
</div>

@endsection 