@extends('Layouts.index') 

@section('titulo-publico', '- Preguntas Frecuentes')

@section('css-publico')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/principal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/preguntasPublic.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tituloEncabezadoGlobal.css') }}">
@endsection

@section('contenido-publico')

        <div class="container">
            <h3>PREGUNTAS FRECUENTES</h3>

            <div class="accordion accordion-flush" id="accordionFlushExample">

                @php
                    $contador = 1
                @endphp
                
                @foreach ($preguntasFrecuntes as $pregunta)
                    <div class="accordion-item">
                        <div class="accordion-css"> 
                            <button class="accordion-button collapsed hols" type="button" data-bs-toggle="collapse" data-bs-target="#flush-{{$contador}}" aria-expanded="false" aria-controls="flush-{{$contador}}">
                                {{$pregunta->pregunta}}
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

@endsection

