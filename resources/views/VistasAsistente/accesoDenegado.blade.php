@extends('Layouts.dashboardAsistente') <!--Esto extiende toda la plantilal del dashboar es decir cargar toda la estructura -->

@section('contenido')
    <h2>Lo siento @auth {{Auth::user()->name}} @endauth, no tienes acceso a esa página :c</h2>
@endsection