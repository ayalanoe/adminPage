@extends('Layouts.dashboard') <!--Esto extiende toda la plantilal del dashboar es decir cargar toda la estructura -->

@section('contenido')
    <?php
        date_default_timezone_set('America/Mexico_City');
        $horaActual = date('G'); // Obtén la hora actual en formato de 24 horas
        $hora2 = $horaActual;
        

        if ($horaActual >= 5 && $horaActual < 12) {
            $mensaje = "Buenos días";
        } elseif ($horaActual >= 12 && $horaActual < 18) {
            $mensaje = "Buenas tardes";
        } else {
            $mensaje = "Buenas noches";
        }
    ?>
    <h1> {{$mensaje}} </h1>
    <h1>Bienvenido, @auth {{Auth::user()->name}} @endauth</h1>
@endsection