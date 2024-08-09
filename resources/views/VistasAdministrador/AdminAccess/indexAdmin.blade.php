@extends('Layouts.dashboard') <!--Esto extiende toda la plantilal del dashboar es decir cargar toda la estructura -->
@section('css')
    <link rel="stylesheet" href="{{ asset('css/cssAdministrador/cardBienvenida.css') }}">
@endsection
@section('contenido')
    <?php
        date_default_timezone_set('America/Mexico_City');
        $horaActual = date('G'); // Obtenemos la hora actual en formato de 24 hora

        if ($horaActual >= 5 && $horaActual < 12) {
            $mensaje ="¡BUENOS DÍAS!";
        } elseif ($horaActual >= 12 && $horaActual < 18) {
            $mensaje ="¡BUENAS TARDES!";
        } else {
            $mensaje ="¡BUENAS NOCHES!";
        }
    ?>
    <div class="card">
        <div class="card-body">
          <div class="row cardContainer">
            <div class="col-md-4">
                <img src="{{ asset('images/logoues.png') }}" alt="" class="img-logo-card">
            </div>
            
            <div class="col-md-8 timeMessage">
              <div class="row pt-3">
                <div class="col-12">
                    <h2>{{$mensaje}}</h2>
                </div>
              </div>
              <div class="row">
                <div class="col-12 message-user">
                    <h6>¡BIENVENID@ DE NUEVO, @auth {{Auth::user()->name}}! 👋 @endauth</h6>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

@endsection