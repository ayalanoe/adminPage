@extends('Layouts.index') 

@section('titulo-publico', '- Facultades')

@section('css-publico')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/principal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/facultades.css') }}">
@endsection

@section('contenido-publico')
<div class="container_tablee">
  <h3 id="h">FACULTADES UES</h3></i>
</div>
<div class="container_table">
    <!--TABLA DE ELEMENTOS-->

    
                <div class="container text-center">
                    <div class="row">
                      <div class="col-4">
                        <div class="p-3 mb-3 faq-section-titlee btncursor" onclick="window.location='{{ route('facultadDirectorio', ['facultadContactos' => 'FM']) }}'">Facultad de Medicina</div>
                      </div>

                      <div class="col-4">
                        <div class="p-3 mb-3 faq-section-titlee btncursor" onclick="window.location='{{ route('facultadDirectorio', ['facultadContactos' => 'FJJCCSS']) }}'">Facultad de Jurisprudencia y Ciencias Sociales</div>
                      </div>
                      <div class="col-4">
                        <div class="p-3 mb-3 faq-section-titlee btncursor" onclick="window.location='{{ route('facultadDirectorio', ['facultadContactos' => 'FCCAA']) }}'">Facultad de Ciencias Agronómicas</div>
                      </div>
                      <div class="col-4">
                        <div class="p-3 mb-3 faq-section-titlee btncursor" onclick="window.location='{{ route('facultadDirectorio', ['facultadContactos' => 'FCCHH']) }}'">Facultad de Ciencias y Humanidades</div>
                      </div>
                      <div class="col-4">
                        <div class="p-3 mb-3 faq-section-titlee btncursor" onclick="window.location='{{ route('facultadDirectorio', ['facultadContactos' => 'FIA']) }}'">Facultad de Ingenieía y Arquitectura</div>
                      </div>
                      <div class="col-4">
                        <div class="p-3 mb-3 faq-section-titlee btncursor" onclick="window.location='{{ route('facultadDirectorio', ['facultadContactos' => 'FQF']) }}'">Facultad de Química y Farmacia</div>
                      </div>
                      <div class="col-4">
                        <div class="p-3 mb-3 faq-section-titlee btncursor" onclick="window.location='{{ route('facultadDirectorio', ['facultadContactos' => 'FOUES']) }}'">Facultad de Odontología</div>
                      </div>
                      <div class="col-4">
                        <div class="p-3 mb-3 faq-section-titlee btncursor" onclick="window.location='{{ route('facultadDirectorio', ['facultadContactos' => 'FCCEE']) }}'">Facultad de Ciencias Económicas</div>
                      </div>
                      <div class="col-4">
                        <div class="p-3 mb-3 faq-section-titlee btncursor" onclick="window.location='{{ route('facultadDirectorio', ['facultadContactos' => 'FCIMAT']) }}'">Facultad de Ciencias Naturales y Matemática</div>
                      </div>
                      <div class="col-4">
                        <div class="p-3 mb-3 faq-section-titlee btncursor" onclick="window.location='{{ route('facultadDirectorio', ['facultadContactos' => 'FMOCC']) }}'">Facultad Multidisciplinaria de Occidente</div>
                      </div>
                      <div class="col-4">
                        <div class="p-3 mb-3 faq-section-titlee btncursor" onclick="window.location='{{ route('facultadDirectorio', ['facultadContactos' => 'FMO']) }}'">Facultad Multidisciplinaria Oriente</div>
                      </div>
                      <div class="col-4">
                        <div class="p-3 mb-3 faq-section-titlee btncursor" onclick="window.location='{{ route('facultadDirectorio', ['facultadContactos' => 'FMP']) }}'">Facultad Multidisciplinaria Paracentral</div>
                      </div>
                      
                    

                    </div>
                  </div>
            
        
        
  
</div>

@endsection