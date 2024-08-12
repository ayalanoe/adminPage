@extends('Layouts.index') 

@section('titulo-publico', '- Requisitos y Fechas')

@section('css-publico')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/styleNav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/formatoTablaCKEditor.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tituloEncabezadoGlobal.css') }}">
@endsection

@section('contenido-publico')

    <div class="container margen-titulo">

        <div class="row justify-content-center mb-4">
            <div class="col-12">
                <h3 class="title-text text-center">REQUISITOS Y FECHAS PARA APLICAR</h3>
            </div>
        </div>

        <div class="container_table">
            @if ($requisitosFecha->isEmpty())
                <div class="alert alert-success text-center">
                    No hay registro
                </div>
                <br><br><br><br><br><br>
            @else

                @foreach($requisitosFecha as $requisito)
                    <div class="container contenedor-tabla">
                        {!! $requisito->contenido !!}
                    </div>
                @endforeach

            @endif
        </div>
        
    </div>

@endsection 