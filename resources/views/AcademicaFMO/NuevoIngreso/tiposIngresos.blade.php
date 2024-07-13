@extends('Layouts.index') 

@section('titulo-publico', '- Tipos de Ingreso')

@section('css-publico')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/principal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tituloEncabezadoGlobal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tiposIngresos.css') }}">
@endsection

@section('contenido-publico')
<div class="container_tablee">
    <h3 id="h">TIPOS DE INGRESO</h3>
</div>
<div class="container_table">

    @if ($tiposDeIngreso->isEmpty())
        <div class="container">
            <div class="alert alert-success">
                No hay registro
            </div>

        </div>
    @else
        <div class="container">          
            <div class="row">
                @foreach ($tiposDeIngreso as $ingreso)
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <div class="card custom-card">
                            <div class="card-body">
                                <div class="title-container">
                                    <h5 class="card-title">{{$ingreso->titulo}}</h5>
                                </div>
                                <hr>
                                
                                <p class="card-text">{!! $ingreso->descripcion !!}</p>
                                <a href="{{route('verInfoTiposIngreso', $ingreso->id)}}" class="btn btn-ver">Ir a la información</a>
                            </div>
                        </div>
                    </div>
                @endforeach
                
            </div>

        </div>
        
    @endif

    
</div>

@endsection 