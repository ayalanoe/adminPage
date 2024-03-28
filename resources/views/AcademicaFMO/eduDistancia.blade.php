@extends('Layouts.index') 

@section('titulo-publico', '- Educación a distancia')

@section('css-publico')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/principal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/directorioPublic.css') }}">
@endsection

@section('contenido-publico')

    <div class="container_table">
        <!--TABLA DE ELEMENTOS-->

            <div class="container">
                <h3>INFORMACIÓN DE CARRERAS A DISTANCIA</h3>
                
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Encargado</th>
                            <th scope="col">Correo Electrónico</th>
                            <th scope="col">Contacto</th>
                            <th scope="col">Trámites a cargo</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <tr>
                            <th scope="row"></th>  
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        
                        </tbody>
                </table>
            </div>
    </div>
@endsection