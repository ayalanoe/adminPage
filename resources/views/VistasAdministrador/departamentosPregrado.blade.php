@extends('Layouts.dashboard')
@section('titulo', '- Departamentos')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/cssAdministrador/textoGestionGlobal.css') }}">   
@endsection
@section('contenido')
<div class="container">
    <h2>Carreras de Pregrado</h2>
    
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Departamento</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>

            <tr>
                <th>1</th>
                <td>Ingeniería y Arquitectura</td>
                <td>
                    <a href="{{ route('carrerasPregrado', ['departamento' => 'INGA']) }}" class="btn btn-primary mx-1">Ver Carreras <i class="fa-solid fa-circle-arrow-right"></i></a>
                </td>
            </tr>

            <tr>
                <th>2</th>
                <td>Medicina</td>
                <td>
                    <a href="{{ route('carrerasPregrado', ['departamento' => 'MED']) }}" class="btn btn-primary mx-1">Ver Carreras <i class="fa-solid fa-circle-arrow-right"></i></a>
                </td>
            </tr>

            <tr>
                <th>3</th>
                <td>Ciencias y Humanidades</td>
                <td>
                    <a href="{{ route('carrerasPregrado', ['departamento' => 'CCHH']) }}" class="btn btn-primary mx-1">Ver Carreras <i class="fa-solid fa-circle-arrow-right"></i></a>
                </td>
            </tr>

            <tr>
                <th>4</th>
                <td>Jurisprudencia y Ciencias Sociales</td>
                <td>
                    <a href="{{ route('carrerasPregrado', ['departamento' => 'JCCSS']) }}" class="btn btn-primary mx-1">Ver Carreras <i class="fa-solid fa-circle-arrow-right"></i></a>
                </td>
            </tr>

            <tr>
                <th>5</th>
                <td>Ciencias Económicas</td>
                <td>
                    <a href="{{ route('carrerasPregrado', ['departamento' => 'CCEE']) }}" class="btn btn-primary mx-1">Ver Carreras <i class="fa-solid fa-circle-arrow-right"></i></a>
                </td>
            </tr>

            <tr>
                <th>6</th>
                <td>Ciencias Naturales y Matemáticas</td>
                <td>
                    <a href="{{ route('carrerasPregrado', ['departamento' => 'CCNN']) }}" class="btn btn-primary mx-1">Ver Carreras <i class="fa-solid fa-circle-arrow-right"></i></a>
                </td>
            </tr>

            <tr>
                <th>7</th>
                <td>Ciencias Agronómicas</td>
                <td>
                    <a href="{{ route('carrerasPregrado', ['departamento' => 'CCAA']) }}" class="btn btn-primary mx-1">Ver Carreras <i class="fa-solid fa-circle-arrow-right"></i></a>
                </td>
            </tr>

            <tr>
                <th>8</th>
                <td>Química y Farmacia</td>
                <td>
                    <a href="{{ route('carrerasPregrado', ['departamento' => 'QQFF']) }}" class="btn btn-primary mx-1">Ver Carreras <i class="fa-solid fa-circle-arrow-right"></i></a>
                </td>
            </tr>

            <tr>
                <th>9</th>
                <td>Planes complementarios</td>
                <td>
                    <a href="{{ route('carrerasPregrado', ['departamento' => 'PLCOM']) }}" class="btn btn-primary mx-1">Ver Carreras <i class="fa-solid fa-circle-arrow-right"></i></a>
                </td>
            </tr>

        </tbody>
    </table>
</div>
    
@endsection