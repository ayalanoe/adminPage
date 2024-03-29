@extends('Layouts.index') 

@section('titulo-publico', '- Directorio de Facultad ')

@section('css-publico')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/principal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/directorioPublic.css') }}">
@endsection

@section('contenido-publico')

    <div class="container_table">
        <!--TABLA DE ELEMENTOS-->

            <div class="container">
                <h3>DIRECTORIO ADMINISTRATIVO DE "NOMBRE FACULTAD AQUI"</h3>
                
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Oficina</th>
                            <th scope="col">Correo Electrónico</th>
                            <th scope="col">Contacto</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>  
                            <td>ss</td>
                            <td>ss</td>
                            <td>ss</td>
                        </tr>
                        </tbody>
                </table>
            </div>
    </div>
@endsection