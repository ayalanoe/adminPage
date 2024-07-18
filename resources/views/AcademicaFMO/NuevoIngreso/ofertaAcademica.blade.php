@extends('Layouts.index') 

@section('titulo-publico', '- Oferta Académica')

@section('css-publico')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/styleNav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/cssPublic/ofertaAcademica.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tituloEncabezadoGlobal.css') }}">
@endsection

@section('contenido-publico')

    <div class="container margen-titulo">

        <div class="row justify-content-center mb-4">
            <div class="col-12">
                <h3 class="title-text text-center">OFERTA ACADÉMICA</h3>
            </div>
        </div>

        <div class="container_table">

            <div class="container">
                <div class="row">

                    <div class="col-12 col-md-6 d-flex">
                        <div class="card flex-fill custom-card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                <div class="title-container">
                                    <h5 class="card-title">Carreras de Pregrado</h5>   
                                </div>
                                <a href="{{route('planesPre')}}" class="btn btn-ver">Ver planes</a>
                                </div>
                                <hr>
                                    @foreach ($carrerasOferta  as $carreras)
                                        @if ($carreras->tipoCarrera == "Carrera_Pregrado")
                                        <p class="item-plan">{{$carreras->carrera}}</p>
                                        @endif
                                    @endforeach
                            </div>
                        </div>
                    </div>
        
                    <div class="col-12 col-md-6 d-flex">
                        <div class="card flex-fill custom-card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                <div class="title-container">
                                <h5 class="card-title">Carreras de Posgrado</h5>
                                </div>
                                <a href="{{route('planesPos')}}" class="btn btn-ver">Ver planes</a>
                                </div>
                                <hr>
                                    @foreach ($carrerasOferta  as $carreras)
                                        @if ($carreras->tipoCarrera == "Carrera_Posgrado")
                                        <p class="item-plan">{{$carreras->carrera}}</p>
                                        @endif
                                    @endforeach
                                
                            </div>
                        </div>
                    </div>
        
                    <div class="col-12 col-md-6 d-flex">
                        <div class="card flex-fill custom-card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                <div class="title-container">
                                <h5 class="card-title">Carreras Técnicas</h5>
                                </div>
                                <a href="{{route('tecnicos')}}" class="btn btn-ver">Ver planes</a>
                                </div>
                                <hr>
                                    @foreach ($carrerasOferta  as $carreras)
                                        @if ($carreras->tipoCarrera == "Carrera_Tecnica")
                                        <p class="item-plan">{{$carreras->carrera}}</p>
                                        @endif
                                    @endforeach
                                
                            </div>
                        </div>
                    </div>
        
                    <div class="col-12 col-md-6 d-flex">
                        <div class="card flex-fill custom-card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="title-container">
                                        <h5 class="card-title">Diplomados impartidos</h5>
                                    </div>
                                    <a href="{{route('diplomados')}}" class="btn btn-ver">Ver planes</a>
                                </div>
                                <hr>
                                    @foreach ($carrerasOferta  as $carreras)
                                        @if ($carreras->tipoCarrera == "Diplomado")
                                        <p class="item-plan">{{$carreras->carrera}}</p>
                                        @endif
                                    @endforeach
                                
                            </div>
                        </div>
                    </div>

                </div>  
            </div>

        </div>

    </div>

@endsection 