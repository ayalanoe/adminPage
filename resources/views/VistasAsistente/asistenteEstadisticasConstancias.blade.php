@extends('Layouts.dashboardAsistente')

<!--Titulo de la pagina, es decir el que aparece en la pestaña, recibe dos parametros
    el parametro 'titulo' es obligatorio y el otro parametro es el nombre que queramos que aparezca en la pestaña
-->
@section('titulo', '- Estadisticas de Constancias') 
@section('css')
    <link rel="stylesheet" href="{{ asset('css/cssAdministrador/registroUsuarios.css') }}">
@endsection

@section('contenido')

    
    <h2>INFORME DE CONSTANCIAS EMITIDAS DEL {{ date('d/m/Y', strtotime($fechaInicial)) }} AL {{date('d/m/Y', strtotime($fechaFinal))}} </h2>
    

    <table class="table table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th scope="col">Tipo de Constancia</th>
                <th scope="col">Total</th>
            </tr>
        </thead>
        <tbody>
            @php
                $numero = 1 
            @endphp

            @foreach ($totalConstancias as $total)
                <tr>
                    <td>{{$numero}}</td>
                    <td>{{ $total->tipoConstancia }}</td>
                    <td>{{ $total->total }}</td>
                </tr>

                @php
                    $numero++
                @endphp
            @endforeach
        </tbody>
    </table>

    
    <div class="row g-0 w-100">
        <div class="col-12 col-md-12 d-flex">       
        
            <div class="col-5">
                <div class="p-3 m-1"> <!--Padding y margin del texto-->
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">Total de Constancias Emitidas: </th>
                        <th scope="col"> {{$totalGeneral}} </th>
                    </tr>
                    </thead>
                </table>  
                </div>
            </div>
        </div>
    </div>
    
@endsection