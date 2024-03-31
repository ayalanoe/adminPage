@extends('Layouts.index') 

@section('titulo-publico', '- Planes de Estudio')

@section('css-publico')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/planPre.css') }}">
@endsection

@section('contenido-publico')
<div class="container_table">

    <div class="row">
        <div class="col-12 col-md-4 d-flex">
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item" id="flush_INGA_header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush_INGA" aria-expanded="false" aria-controls="flush_INGA">
                            Ingeniería y Arquitectura
                        </button>
                    
                    <div id="flush_INGA" class="accordion-collapse collapse" aria-labelledby="flush_INGA_header" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <a class="nav-link" href="#">
                                Arquitectura
                            </a>      
                            <a class="nav-link" href="#">
                                Ingeniería Agronómica
                            </a>  
                            <a class="nav-link" href="#">
                                Ingeniería Civil
                            </a>
                            <a class="nav-link" href="#">
                                Ingeniería de Sistemas Informáticos
                            </a>
                            <a class="nav-link" href="#">
                                Ingeniería Eléctrica
                            </a>                                    
                            <a class="nav-link" href="#">
                                Ingeniería Mécanica
                            </a>
                            <a class="nav-link" href="#">
                                Ingeniería Industrial
                            </a>
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
                        
                    <div id="flush_MED" class="accordion-collapse collapse"  aria-labelledby="flush_INGA_header" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <a class="nav-link" href="#">
                                Arquitectura
                            </a>      
                            <a class="nav-link" href="#">
                                Ingeniería Agronómica
                            </a>  
                            <a class="nav-link" href="#">
                                Ingeniería Civil
                            </a>
                            <a class="nav-link" href="#">
                                Ingeniería de Sistemas Informáticos
                            </a>
                            <a class="nav-link" href="#">
                                Ingeniería Eléctrica
                            </a>                                    
                            <a class="nav-link" href="#">
                                Ingeniería Mécanica
                            </a>
                            <a class="nav-link" href="#">
                                Ingeniería Industrial
                            </a>
                        </div>
                    </div>
                </div>
            </div>    
        </div>
        <div class="col-12 col-md-4 d-flex">
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                                
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush_CCHH" aria-expanded="false" aria-controls="flush-collapseThree">
                        Ciencias y Humanidades
                    </button>
                
                    <div id="flush_CCHH" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the third item's accordion body. Nothing more exciting happening here in terms of content, but just filling up the space to make it look, at least at first glance, a bit more representative of how this would look in a real-world application.</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4 d-flex">
            <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                                    
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush_JJCC" aria-expanded="false" aria-controls="flush-collapseOne">
                            Jurisprudencia y Ciencias Sociales
                        </button>
                    
                    <div id="flush_JJCC" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the first item's accordion body.</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4 d-flex">
            <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                                    
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush_CCEE" aria-expanded="false" aria-controls="flush-collapseOne">
                            Ciencias Económicas
                        </button>
                
                    <div id="flush_CCEE" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the first item's accordion body.</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4 d-flex">
            <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                                    
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush_CCNN" aria-expanded="false" aria-controls="flush-collapseOne">
                            Ciencias Naturales y Matemáticas
                        </button>
                    
                    <div id="flush_CCNN" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the first item's accordion body.</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4 d-flex">
            <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                                    
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush_CCAA" aria-expanded="false" aria-controls="flush-collapseOne">
                            Ciencias Agronómicas
                        </button>
                    
                    <div id="flush_CCAA" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the first item's accordion body.</div>
                    </div>
                </div>
            </div>
        </div>
        
        
    </div>
        <div class="col-12 col-md-4 d-flex">
            
        </div>
    </div>

    

                        
                        
                        


</div>          
@endsection

@section('jsVistasPublicas')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@endsection


