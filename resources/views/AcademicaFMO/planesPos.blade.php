@extends('Layouts.index') 

@section('titulo-publico', '- Posgrado')

@section('css-publico')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/principal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/planPre.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tituloEncabezadoGlobal.css') }}">
@endsection

@section('contenido-publico')
<h3>CARRERAS DE POSGRADO</h3>
<div class="container_table">

    <div class="row">

        <div class="col-12 col-md-4 d-flex">
            <div class="accordion-item">
                <div class="accordion-css"> 
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush_INGA" aria-expanded="false" aria-controls="#flush_INGA">
                        Carreras de Posgrados
                    </button>
                </div>
                <div id="flush_INGA" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        @foreach ($planesPosgrado as $carreraPosgrado)
                            <a target="_blank" class="nav-link" href="#">
                                {{$carreraPosgrado->carrera}}
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


