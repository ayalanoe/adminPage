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
                @php
                    $contador = 1
                @endphp
                    
                @foreach ($preguntasFrecuntes as $pregunta)
                    <div class="row">
                        <div class="col-12 col-md-4 d-flex">
                            
                                <button class="btn btn-linkr collapsed faq-section-titleeee" id="ac" type="button" data-toggle="collapse" data-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
                                    {{$pregunta->pregunta}}</a>
                                </button>
                            
                        </div>
                    </div>
                    @php
                        $contador++
                    @endphp
                @endforeach

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

        <div id="scrollUp" title="Scroll To Top" style="display: block;">
            <svg class="svg-inline--fa fa-arrow-up fa-w-14" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="arrow-up" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M34.9 289.5l-22.2-22.2c-9.4-9.4-9.4-24.6 0-33.9L207 39c9.4-9.4 24.6-9.4 33.9 0l194.3 194.3c9.4 9.4 9.4 24.6 0 33.9L413 289.4c-9.5 9.5-25 9.3-34.3-.4L264 168.6V456c0 13.3-10.7 24-24 24h-32c-13.3 0-24-10.7-24-24V168.6L69.2 289.1c-9.3 9.8-24.8 10-34.3.4z"></path></svg><!-- <i class="fas fa-arrow-up"></i> -->
        </div>


@endsection

