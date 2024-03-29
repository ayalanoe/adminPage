@extends('Layouts.index') 

@section('titulo-publico', '- Anuncios Académicos')

@section('css-publico')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/tramitesPublic.css') }}">
@endsection

@section('contenido-publico')
<div class="container_table">
    <!--TABLA DE ELEMENTOS-->

        <div class="container">
            <h3>AQUI EL TÍTULO DEL TRÁMITE</h3>
            
        </div>
</div>

@endsection