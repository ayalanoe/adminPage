@extends('Layouts.index') 

@section('titulo-publico', '- Anuncios Académicos')

@section('css-publico')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/anunciosPublic.css') }}">
@endsection

@section('contenido-publico')

        <div class="container">
            <h3>ANUNCIOS ACADÉMICOS</h3>
            <i class="fa-solid fa-chevron-down fa-3x"></i>
        </div>

        
        <div class="container">
            <!-- contenedor de tarjetas de plataformas-->
            <div class="row">
                <div class="col-12 col-md-4 d-flex">
                
                        <div class="card flex-fill border-0 illustration" style="width: 18rem;">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT1_vufqfaRZkbH_boi2ENFy9pCLcXq3l_T0xY5RH_p&s" class="card-img-top" alt="...">
                            <div class="card-body">
                            <h5 class="card-title">Calendario Memoria Histórica</h5>
                            <p class="card-text">Se les invita a descargar y conocer el Calendario de la Memoria Histórica de la Universidad de El Salvador del año 2024. Lo puedes decargar en el siguiente enlace:</p>
                            <a href="#" class="btn btn-primary">Leer más</a>
                            </div>
                        </div>
                    
                </div>
                

                <div class="col-12 col-md-4 d-flex">
                
                    <div class="card flex-fill border-0 illustration">
                        <img src="{{ asset('images/vacation.jpg') }}" class="card-img-top" alt="...">
                        <div class="card-body">
                        <h5 class="card-title">Calendario Memoria Histórica</h5>
                        <p class="card-text">Se les invita a descargar y conocer el Calendario de la Memoria Histórica de la Universidad de El Salvador del año 2024. Lo puedes decargar en el siguiente enlace:</p>
                        <a href="#" class="btn btn-primary">Leer más</a>
                        </div>
                    </div>
                
                </div>


                <div class="col-12 col-md-4 d-flex">
                
                        <div class="card flex-fill border-0 illustration" style="width: 18rem;">
                            <img src="{{ asset('images/fmo.png') }}" class="card-img-top" alt="...">
                            <div class="card-body">
                            <h5 class="card-title">Calendario Memoria Histórica</h5>
                            <p class="card-text">Se les invita a descargar y conocer el Calendario de la Memoria Histórica de la Universidad de El Salvador del año 2024. Lo puedes decargar en el siguiente enlace:</p>
                            <a href="#" class="btn btn-primary">Leer más</a>
                            </div>
                        </div>
                    
                </div>
            </div>

        </div>


@endsection