@extends('Layouts.index') 

@section('titulo-publico', '- Preguntas Frecuentes')

@section('css-publico')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/styleNav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/preguntasPublic.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tituloEncabezadoGlobal.css') }}">

    <!-- Link de css para darle formato a la tabla que se crea con el CKeditor desde el admin -->
    <link rel="stylesheet" href="{{ asset('css/formatoTablaCKEditor.css') }}">
@endsection

@section('contenido-publico')

    <div class="container margen-titulo">

        <div class="row justify-content-center mb-4">
            <div class="col-12">
                <h3 class="title-text text-center">PREGUNTAS FRECUENTES</h3>
            </div>
        </div>

        <div class="container_table">
            @if ($preguntasFrecuntes->isEmpty())
                <div class="alert alert-success text-center">
                    No hay preguntas publicadas.
                </div>
                <br><br><br><br><br><br>
            @else
                <div class="container">

                    <div class="accordion accordion-flush" id="accordionFlushExample">
        
                        @php
                            $contador = 1
                        @endphp
                        
                        @foreach ($preguntasFrecuntes as $pregunta)
                            <div class="accordion-item">
                                <div class="accordion-css"> 
                                    <button class="accordion-button collapsed btnacc" type="button" data-bs-toggle="collapse" data-bs-target="#flush-{{$contador}}" aria-expanded="false" aria-controls="flush-{{$contador}}">
                                        <h5>{{$pregunta->pregunta}}</h5>
                                        <span class="accordion-icon"></span>
                                    </button>
                                </div>
                                <div id="flush-{{$contador}}" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        {!!$pregunta->respuesta !!}
                                    </div>
                                </div>
                            </div>
                            
        
                            @php
                                $contador++
                            @endphp
                        @endforeach
                        
                    </div>

                </div>

                <br><br>
            @endif
        </div>
    </div>


@endsection

