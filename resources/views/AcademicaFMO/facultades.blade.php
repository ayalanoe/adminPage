@extends('Layouts.index') 

@section('titulo-publico', '- Facultades')

@section('css-publico')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/facultades.css') }}">
@endsection

@section('contenido-publico')
<div class="container_table">
    <!--TABLA DE ELEMENTOS-->

    <div class="card border-0">
        <div class="card-header">
                <div class="container text-center">
                    <div class="row g-2">
                      <div class="col-4">
                        <div class="p-3 mb-2 faq-section-titlee"><i class="fa-solid fa-stethoscope"></i> Facultad de Medicina</div>
                      </div>
                      <div class="col-4">
                        <div class="p-3 mb-2 faq-section-titlee"><i class="fa-solid fa-gavel"></i> Facultad de Jurisprudencia y Ciencias Sociales</div>
                      </div>
                      <div class="col-4">
                        <div class="p-3 mb-2 faq-section-titlee"> <i class="fa-solid fa-building-wheat"></i>Facultad de Ciencias Agronómicas</div>
                      </div>
                      <div class="col-4">
                        <div class="p-3 mb-2 faq-section-titlee">Facultad de Ciencias y Humanidades</div>
                      </div>
                      <div class="col-4">
                        <div class="p-3 mb-2 faq-section-titlee">Facultad de Ingenieía y Arquitectura</div>
                      </div>
                      <div class="col-4">
                        <div class="p-3 mb-2 faq-section-titlee">Facultad de Química y Farmacia</div>
                      </div>
                      <div class="col-4">
                        <div class="p-3 faq-section-titlee">Facultad de Odontología</div>
                      </div>
                      <div class="col-4">
                        <div class="p-3 faq-section-titlee">Facultad de Ciencias Económicas</div>
                      </div>
                      <div class="col-4">
                        <div class="p-3 faq-section-titlee">Facultad de Ciencias Naturales y Matemática</div>
                      </div>
                      <div class="col-4">
                        <div class="p-3 faq-section-titlee">Facultad Multidisciplinaria de Occidente</div>
                      </div>
                      <div class="col-4">
                        <div class="p-3 faq-section-titlee">Facultad Multidisciplinaria Oriente</div>
                      </div>
                      <div class="col-4">
                        <div class="p-3 faq-section-titlee">Facultad Multidisciplinaria Paracentral</div>
                      </div>
                    </div>
                  </div>
            
        </div>

        <div class="card-body">
            <div id="accordion">
                <div class="faq-section-title">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
                        Comercios
                    </button>
                </div>
                <div class="faq-section-title">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
                        Comercios
                    </button>
                </div>
                <div class="faq-section-title">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
                        Comercios
                    </button>
                </div>
            </div>
        </div>
        
    </div>
</div>

@endsection