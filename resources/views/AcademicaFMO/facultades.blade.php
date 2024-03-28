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
            <div class="container">
                
                <p>LISTA DE FACULTADES</p>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Facultad</th>
                            <th scope="col">Correo Institucional</th>
                            <th scope="col">Contacto</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $numero = 1 
                        @endphp
                    
                        @foreach ($facultad as $facultadC)
                        <tr>
                            <th scope="row">{{$numero}}</th>  
                            <td>{{$facultadC->facultad}}</td>
                            <td>{{$facultadC->correo}}</td>
                            <td>{{$facultadC->contacto}}</td>
                        </tr>
                        @php
                            $numero++
                        @endphp
                        @endforeach
                        </tbody>
                </table>
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