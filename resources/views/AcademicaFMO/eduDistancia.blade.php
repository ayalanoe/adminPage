@extends('Layouts.index') 

@section('titulo-publico', '- Educación a distancia')

@section('css-publico')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/principal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/eduDistanciaPublic.css') }}">
@endsection

@section('contenido-publico')

<div class="container">
    <h3>INFORMACIÓN SOBRE CARRERAS A DISTANCIA</h3>
    <i class="fa-solid fa-chevron-down fa-3x"></i>
</div>


<div class="container">
    <!-- contenedor de tarjetas de plataformas-->
    <div class="row">
        <div class="col-12 col-md-6 d-flex">
        
                <div class="card flex-fill border-0 illustration" style="width: 18rem;">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT1_vufqfaRZkbH_boi2ENFy9pCLcXq3l_T0xY5RH_p&s" class="card-img-top" alt="...">
                    <div class="card-body">
                    <h5 class="card-title">Licenciatura en Informática Educativa</h5>
                    <p class="card-text">Se les invita a descargar:</p>
                    <a href="#" class="btn btn-primary">Leer más</a>
                    </div>
                </div>
            
        </div>
        

        <div class="col-12 col-md-6 d-flex">
        
            <div class="card flex-fill border-0 illustration">
                <img src="{{ asset('images/vacation.jpg') }}" class="card-img-top" alt="...">
                <div class="card-body">
                <h5 class="card-title">Licenciatura en enseñanza de las Ciencias Naturales</h5>
                <p class="card-text">Se les invita a descargar:</p>
                <a href="#" class="btn btn-primary">Leer más</a>
                </div>
            </div>
        
        </div>


        <div class="col-12 col-md-6 d-flex">
        
                <div class="card flex-fill border-0 illustration" style="width: 18rem;">
                    <img src="{{ asset('images/fmo.png') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                    <h5 class="card-title">Licenciatura en enseñanza del Inglés</h5>
                    <p class="card-text">Se les invita a descargar:</p>
                    <a href="#" class="btn btn-primary">Leer más</a>
                    </div>
                </div>
            
        </div>
        <div class="col-12 col-md-6 d-flex">
        
            <div class="card flex-fill border-0 illustration" style="width: 18rem;">
                <img src="{{ asset('images/fmo.png') }}" class="card-img-top" alt="...">
                <div class="card-body">
                <h5 class="card-title">Licenciatura en enseñanza de la Matemática</h5>
                <p class="card-text">Se les invita a descargar::</p>
                <a href="#" class="btn btn-primary">Leer más</a>
                </div>
            </div>
        
    </div>
    </div>

</div>
@endsection