@extends('Layouts.index') 

@section('titulo-publico', ' - Diplomados')

@section('css-publico')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/principal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/planPre.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tituloEncabezadoGlobal.css') }}">
@endsection

@section('contenido-publico')
<div class="container_tablee">
    <h3 id="h">DIPLOMADOS</h3>
</div>
<div class="container_table">

    
        <div class="container">          
            <div class="row">
     
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">TITULO DEL DIPLOMADO</h5>
                                <a href="{{ route('verInfoDiplomado') }}" class="btn btn-primary">Más detalles</a>
                            </div>
                        </div>
                    </div>

                
            </div>

        </div>
        
    
</div>
        
@endsection




