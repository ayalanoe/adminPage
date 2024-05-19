@extends('Layouts.dashboard')
@section('titulo', '- Carreras Distancia FMO')

@section('contenido')

    <div class="container">
        <h2>Gestión de carreras a distancia de la FMO</h2>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Carrera</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $numero = 1 
                @endphp
        
                @foreach ($carrerasDisFMO as $carreraFMO)
                <tr>
                    <th scope="row">{{$numero}}</th>  
                    <td>{{$carreraFMO->carrera}}</td>

                    <td class="d-flex">
        
                        <form action="{{ route('elimarCarDisFmo', $carreraFMO->id)}}" class="formDeleteCarDisFMO" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger mx-1"><i class="fa-solid fa-trash"></i></button>
                        </form> 
                        
                        <a href="{{ route('vistaEditarCarDisFMO', $carreraFMO->id) }}" class="btn btn-primary mx-1">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        
                    </td>

                </tr>
                @php
                    $numero++
                @endphp

                @endforeach

            </tbody>
        </table>
    </div>

    <!-- Bton para poder insertar una carrera a distancia de la fmo -->
    <div class="container">
        <a href="{{ route('vistaCrearCarDisFmo') }}" class="btn btn-success mx-1"><i class="fa-solid fa-plus"></i> Agregar Carrera A Distancia</a>
    </div>
    
@endsection

@section('jsVistasAdmin')

    @if (Session::has('resGuardarCarDisFMO'))
        <script>
        Swal.fire({
            title: "Informacion",
            text: "{{ session('resGuardarCarDisFMO') }}",
            icon: "success"
        });
        </script>  
    @endif

    @if (Session::has('resNewDatosCarDisFMO'))
        <script>
        Swal.fire({
            title: "Informacion",
            text: "{{ session('resNewDatosCarDisFMO') }}",
            icon: "success"
        });
        </script>  
    @endif

    @if (Session::has('resEliminarCarDistanciaFMO'))
        <script>
        Swal.fire({
            title: "Informacion",
            text: "{{ session('resEliminarCarDistanciaFMO') }}",
            icon: "success"
        });
        </script>  
    @endif

    <script>
        $('.formDeleteCarDisFMO').on('submit', function(e){
            e.preventDefault();

            Swal.fire({
                title: "¿Está seguro?",
                text: "Se eliminará la carrera",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, eliminar"
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit()
                } 
            });

        })
    </script>

@endsection