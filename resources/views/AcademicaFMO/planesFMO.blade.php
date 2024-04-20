@extends('Layouts.index') 

@section('titulo-publico', '- Pregrado')

@section('css-publico')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/principal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/planPre.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tituloEncabezadoGlobal.css') }}">
@endsection

@section('contenido-publico')
<h3>CARRERAS DE PREGRADO</h3>
<div class="container_table">

    <div class="row">

        <div class="col-12 col-md-4 d-flex">
            <div class="accordion-item">
                <div class="accordion-css"> 
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush_INGA" aria-expanded="false" aria-controls="#flush_INGA">
                        Ingeniería y Arquitectura
                    </button>
                </div>
                <div id="flush_INGA" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        @foreach ($planesPregrado as $carreraPregrado)
                                @if ($carreraPregrado->departamento == "INGA")
                                    <a target="_blank" class="nav-link" href="{{ route('publicArchivoPregrado', $carreraPregrado->id)}}">
                                        {{$carreraPregrado->carrera}}
                                    </a> 
                                @endif
                            @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4 d-flex">
            <div class="accordion-item">
                <div class="accordion-css"> 
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush_MED" aria-expanded="false" aria-controls="#flush_MED">
                        Medicina
                    </button>
                </div>
                <div id="flush_MED" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        @foreach ($planesPregrado as $carreraPregrado)
                            @if ($carreraPregrado->departamento == "MED")
                                <a target="_blank" class="nav-link" href="{{ route('publicArchivoPregrado', $carreraPregrado->id)}}">
                                    {{$carreraPregrado->carrera}}
                                </a> 
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4 d-flex">
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item" id="flush_CCHH_header">
                    <button class="accordion-button collapsed btnAccordion" type="button" data-bs-toggle="collapse" data-bs-target="#flush_CCHH" aria-expanded="false" aria-controls="flush_CCHH">
                        Ciencias y Humanidades
                    </button>
                    
                    <div id="flush_CCHH" class="accordion-collapse collapse" aria-labelledby="flush_CCHH_header" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">

                            @foreach ($planesPregrado as $carreraPregrado)
                                @if ($carreraPregrado->departamento == "CCHH")
                                    <a target="_blank" class="nav-link" href="{{ route('publicArchivoPregrado', $carreraPregrado->id)}}">
                                        {{$carreraPregrado->carrera}}
                                    </a> 
                                @endif
                            @endforeach
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4 d-flex">
            <div class="accordion-item">
                <div class="accordion-css"> 
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush_JCCSS" aria-expanded="false" aria-controls="#flush_JCCSS">
                        Jurisprudencia y Ciencias Sociales
                    </button>
                </div>
                <div id="flush_JCCSS" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        @foreach ($planesPregrado as $carreraPregrado)
                            @if ($carreraPregrado->departamento == "JCCSS")
                                <a target="_blank" class="nav-link" href="{{ route('publicArchivoPregrado', $carreraPregrado->id)}}">
                                    {{$carreraPregrado->carrera}}
                                </a> 
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4 d-flex">
            <div class="accordion-item">
                <div class="accordion-css"> 
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush_CCEE" aria-expanded="false" aria-controls="#flush_CCEE">
                        Ciencias Económicas
                    </button>
                </div>
                <div id="flush_CCEE" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        @foreach ($planesPregrado as $carreraPregrado)
                            @if ($carreraPregrado->departamento == "CCEE")
                                <a target="_blank" class="nav-link" href="{{ route('publicArchivoPregrado', $carreraPregrado->id)}}">
                                    {{$carreraPregrado->carrera}}
                                </a> 
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4 d-flex">
            <div class="accordion-item">
                <div class="accordion-css"> 
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush_CCNN" aria-expanded="false" aria-controls="#flush_CCNN">
                        Ciencias Naturales y Matemáticas
                    </button>
                </div>
                <div id="flush_CCNN" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        @foreach ($planesPregrado as $carreraPregrado)
                            @if ($carreraPregrado->departamento == "CCNN")
                                <a target="_blank" class="nav-link" href="{{ route('publicArchivoPregrado', $carreraPregrado->id)}}">
                                    {{$carreraPregrado->carrera}}
                                </a> 
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4 d-flex">
            <div class="accordion-item">
                <div class="accordion-css"> 
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush_CCAA" aria-expanded="false" aria-controls="#flush_CCAA">
                        Ciencias Agronómicas
                    </button>
                </div>
                <div id="flush_CCAA" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        @foreach ($planesPregrado as $carreraPregrado)
                            @if ($carreraPregrado->departamento == "CCAA")
                                <a target="_blank" class="nav-link" href="{{ route('publicArchivoPregrado', $carreraPregrado->id)}}">
                                    {{$carreraPregrado->carrera}}
                                </a> 
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4 d-flex">
            <div class="accordion-item">
                <div class="accordion-css"> 
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush_QQFF" aria-expanded="false" aria-controls="#flush_QQFF">
                        Química y Farmacia
                    </button>
                </div>
                <div id="flush_QQFF" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        @foreach ($planesPregrado as $carreraPregrado)
                            @if ($carreraPregrado->departamento == "QQFF")
                                <a target="_blank" class="nav-link" href="{{ route('publicArchivoPregrado', $carreraPregrado->id)}}">
                                    {{$carreraPregrado->carrera}}
                                </a> 
                            @endif
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


