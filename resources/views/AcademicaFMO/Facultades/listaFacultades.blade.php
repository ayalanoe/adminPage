@extends('Layouts.index') 

@section('titulo-publico', '- Facultades')

@section('css-publico')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/styleNav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/facultades.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tituloEncabezadoGlobal.css') }}">
@endsection

@section('contenido-publico')

    <div class="container margen-titulo">

        <div class="row justify-content-center mb-4">
            <div class="col-12">
                <h3 class="title-text text-center">FACULTADES UES</h3>
            </div>
        </div>

        <div class="container_table">
            <div class="row">

                <div class="col-12 col-sm-6 col-md-4 mb-3">
                    <div class="card h-100">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div>
                                <h5 class="card-title">Facultad de Medicina</h5>
                            </div>
                            <a href="{{ route('facultadDirectorio', ['facultadContactos' => 'FM']) }}" class="btn btn-custom">Ver contactos</a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-4 mb-3">
                    <div class="card h-100">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div>
                                <h5 class="card-title">Facultad de Jurisprudencia y Ciencias Sociales</h5>
                            </div>
                            <a href="{{ route('facultadDirectorio', ['facultadContactos' => 'FJJCCSS']) }}" class="btn btn-custom">Ver contactos</a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-4 mb-3">
                    <div class="card h-100">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div>
                                <h5 class="card-title">Facultad de Ciencias Agronómicas</h5>
                            </div>
                            <a href="{{ route('facultadDirectorio', ['facultadContactos' => 'FCCAA']) }}" class="btn btn-custom">Ver contactos</a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-4 mb-3">
                    <div class="card h-100">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div>
                                <h5 class="card-title">Facultad de Ciencias y Humanidades</h5>
                            </div>
                            <a href="{{ route('facultadDirectorio', ['facultadContactos' => 'FCCHH']) }}" class="btn btn-custom">Ver contactos</a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-4 mb-3">
                    <div class="card h-100">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div>
                                <h5 class="card-title">Facultad de Ingeniería y Arquitectura</h5>
                            </div>
                            <a href="{{ route('facultadDirectorio', ['facultadContactos' => 'FIA']) }}" class="btn btn-custom">Ver contactos</a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-4 mb-3">
                    <div class="card h-100">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div>
                                <h5 class="card-title">Facultad de Química y Farmacia</h5>
                            </div>
                            <a href="{{ route('facultadDirectorio', ['facultadContactos' => 'FQF']) }}" class="btn btn-custom">Ver contactos</a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-4 mb-3">
                    <div class="card h-100">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div>
                                <h5 class="card-title">Facultad de Odontología</h5>
                            </div>
                            <a href="{{ route('facultadDirectorio', ['facultadContactos' => 'FOUES']) }}" class="btn btn-custom">Ver contactos</a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-4 mb-3">
                    <div class="card h-100">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div>
                                <h5 class="card-title">Facultad de Ciencias Económicas</h5>
                            </div>
                            <a href="{{ route('facultadDirectorio', ['facultadContactos' => 'FCCEE']) }}" class="btn btn-custom">Ver contactos</a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-4 mb-3">
                    <div class="card h-100">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div>
                                <h5 class="card-title">Facultad de Ciencias Naturales y Matemática</h5>
                            </div>
                            <a href="{{ route('facultadDirectorio', ['facultadContactos' => 'FCIMAT']) }}" class="btn btn-custom">Ver contactos</a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-4 mb-3">
                    <div class="card h-100">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div>
                                <h5 class="card-title">Facultad Multidisciplinaria de Occidente</h5>
                            </div>
                            <a href="{{ route('facultadDirectorio', ['facultadContactos' => 'FMOCC']) }}" class="btn btn-custom">Ver contactos</a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-4 mb-3">
                    <div class="card h-100">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div>
                                <h5 class="card-title">Facultad Multidisciplinaria Oriental</h5>
                            </div>
                            <a href="{{ route('facultadDirectorio', ['facultadContactos' => 'FMO']) }}" class="btn btn-custom">Ver contactos</a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-4 mb-3">
                    <div class="card h-100">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div>
                                <h5 class="card-title">Facultad Multidisciplinaria Paracentral</h5>
                            </div>
                            <a href="{{ route('facultadDirectorio', ['facultadContactos' => 'FMP']) }}" class="btn btn-custom">Ver contactos</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>


@endsection

