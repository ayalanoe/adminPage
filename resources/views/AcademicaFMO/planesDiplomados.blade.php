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
<p>Diplomados</p>
        <div class="col-12 col-md-4 d-flex">
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item" id="flush_INGA_header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush_INGA" aria-expanded="false" aria-controls="flush_INGA">
                        Ingeniería y Arquitectura
                    </button>
                    
                    <div id="flush_INGA" class="accordion-collapse collapse" aria-labelledby="flush_INGA_header" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">

                            
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4 d-flex">
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item" id="flush_MED_header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush_MED" aria-expanded="false" aria-controls="flush_MED">
                        Medicina
                    </button>
                    
                    <div id="flush_MED" class="accordion-collapse collapse" aria-labelledby="flush_MED_header" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">

                            
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4 d-flex">
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item" id="flush_CCHH_header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush_CCHH" aria-expanded="false" aria-controls="flush_CCHH">
                        Ciencias y Humanidades
                    </button>
                    
                    <div id="flush_CCHH" class="accordion-collapse collapse" aria-labelledby="flush_CCHH_header" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">

                            
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4 d-flex">
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item" id="flush_JCCSS_header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush_JCCSS" aria-expanded="false" aria-controls="flush_JCCSS">
                        Jurisprudencia y Ciencias Sociales
                    </button>
                    
                    <div id="flush_JCCSS" class="accordion-collapse collapse" aria-labelledby="flush_JCCSS_header" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">

                            
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4 d-flex">
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item" id="flush_CCEE_header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush_CCEE" aria-expanded="false" aria-controls="flush_CCEE">
                        Ciencias Económicas
                    </button>
                    
                    <div id="flush_CCEE" class="accordion-collapse collapse" aria-labelledby="flush_CCEE_header" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">

                           
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4 d-flex">
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item" id="flush_CCNN_header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush_CCNN" aria-expanded="false" aria-controls="flush_CCNN">
                        Ciencias Naturales y Matemáticas
                    </button>
                    
                    <div id="flush_CCNN" class="accordion-collapse collapse" aria-labelledby="flush_CCNN_header" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">

                           
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4 d-flex">
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item" id="flush_CCAA_header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush_CCAA" aria-expanded="false" aria-controls="flush_CCAA">
                        Ciencias Agronómicas
                    </button>
                    
                    <div id="flush_CCAA" class="accordion-collapse collapse" aria-labelledby="flush_CCAA_header" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">

                           
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4 d-flex">
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item" id="flush_QQFF_header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush_QQFF" aria-expanded="false" aria-controls="flush_QQFF">
                        Química y Farmacia
                    </button>
                    
                    <div id="flush_QQFF" class="accordion-collapse collapse" aria-labelledby="flush_QQFF_header" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">

                           
                            
                        </div>
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


