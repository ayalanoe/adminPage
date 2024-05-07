@extends('Layouts.index') 

@section('titulo-publico', '- Diplomados')

@section('css-publico')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/principal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/planPre.css') }}">
@endsection

@section('contenido-publico')
<div class="container_table">

    <div class="row">

        <div class="col-12 col-md-4 d-flex">
            <div class="accordion-item">
                <div class="accordion-css"> 
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush_INGA" aria-expanded="false" aria-controls="#flush_INGA">
                        Carreras Técnicas
                    </button>
                </div>
                <div id="flush_INGA" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        @foreach ($carrerasTecnicas as $carTecnica)
                            <a href="{{route('mostrarPDFCarTec', $carTecnica->id)}}" target="_blank" class="nav-link" href="#">
                                {{$carTecnica->carrera}}
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


