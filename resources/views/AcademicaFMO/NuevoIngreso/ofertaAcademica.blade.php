@extends('Layouts.index') 

@section('titulo-publico', '- Oferta Académica')

@section('css-publico')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/principal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/eduDistanciaPublic.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tituloEncabezadoGlobal.css') }}">
@endsection

@section('contenido-publico')
<div class="container_tablee">
    <h3 id="h">OFERTA ACADÉMICA</h3>
</div>
<div class="container_table">

    <div class="container">
        <div class="row">

            <div class="col-12 col-md-6 d-flex">
                <div class="card flex-fill border-0 illustration">
                    <div class="card-body">
                        <h5 class="card-title">Carreras de Pregrado</h5>
                        <hr>
                            @foreach ($carrerasOferta  as $carreras)
                                @if ($carreras->tipoCarrera == "Carrera_Pregrado")
                                <p class="card-text">{{$carreras->carrera}}</p>
                                @endif
                            @endforeach
                        <a href="{{route('planesPre')}}" class="btn btn-primary">Ver planes</a>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 d-flex">
                <div class="card flex-fill border-0 illustration">
                    <div class="card-body">
                        <h5 class="card-title">Carreras de Posgrado</h5>
                        <hr>
                            @foreach ($carrerasOferta  as $carreras)
                                @if ($carreras->tipoCarrera == "Carrera_Posgrado")
                                <p class="card-text">{{$carreras->carrera}}</p>
                                @endif
                            @endforeach
                        <a href="{{route('planesPos')}}" class="btn btn-primary">Ver planes</a>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 d-flex">
                <div class="card flex-fill border-0 illustration">
                    <div class="card-body">
                        <h5 class="card-title">Carreras Técnicas</h5>
                        <hr>
                            @foreach ($carrerasOferta  as $carreras)
                                @if ($carreras->tipoCarrera == "Carrera_Tecnica")
                                <p class="card-text">{{$carreras->carrera}}</p>
                                @endif
                            @endforeach
                        <a href="{{route('tecnicos')}}" class="btn btn-primary">Ver planes</a>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 d-flex">
                <div class="card flex-fill border-0 illustration">
                    <div class="card-body">
                        <h5 class="card-title">Diplomados impartidos</h5>
                        <hr>
                            @foreach ($carrerasOferta  as $carreras)
                                @if ($carreras->tipoCarrera == "Diplomado")
                                <p class="card-text">{{$carreras->carrera}}</p>
                                @endif
                            @endforeach
                        <a href="{{route('diplomados')}}" class="btn btn-primary">Ver planes</a>
                    </div>
                </div>
            </div>

            
        </div>
            
    </div>

</div>

@endsection 