@extends('Layouts.dashboard')
@section('titulo', '- Requisitos y Fechas')

@section('contenido')

    <div class="container">
        <h2>Requisitos y Fechas</h2>
        <hr>

        @if ($requisitosYfechas->isEmpty())
            <div class="alert alert-warning">
                No hay registro
            </div>
        @else

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Registro</th>
                        <th scope="col">Fecha Publicación</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $numero = 1 
                    @endphp

                    @foreach ($requisitosYfechas as $reqFechas)
                        <tr>
                            <th scope="row">{{$numero}}</th>  
                            <td>{{$reqFechas->titulo}}</td>
                            <td>{{ date('d-m-Y', strtotime($reqFechas->fechaPublicacion)) }}</td>

                            <td class="d-flex">
                                <form action="{{route('eliminarReqFechaIngreso', $reqFechas->id)}}" class="formEliminarReqFecha" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger mx-1"><i class="fa-solid fa-trash"></i></button>
                                </form>

                                <a href="{{ route('vistaReqFechaEditar', $reqFechas->id)}}" class="btn btn-primary mx-1">
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
            
        @endif

    </div>

    @if ($requisitosYfechas->isEmpty())
        <div class="container">
            <a href="{{ route('infoReqFe') }}" class="btn btn-success mx-1"><i class="fa-solid fa-plus"></i> Registrar información</a>
        </div>
    @endif

@endsection

@section('jsVistasAdmin')

    <script>
        $('.formEliminarReqFecha').on('submit', function(e){
            e.preventDefault();

            Swal.fire({
                title: "¿Está seguro?",
                text: "Se eliminará los requisitos y fechas",
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

    @if (Session::has('resReqFechaIngres'))
        <script>
            Swal.fire({
                title: "Informacion",
                text: "{{ session('resReqFechaIngres') }}",
                icon: "success"
            });
        </script>  
    @endif

    @if (Session::has('resEditReqFecha'))
        <script>
            Swal.fire({
                title: "Informacion",
                text: "{{ session('resEditReqFecha') }}",
                icon: "success"
            });
        </script>  
    @endif

    @if (Session::has('errorReqFechaIngreso'))
        <script>
            Swal.fire({
                title: "Informacion",
                text: "{{ session('errorReqFechaIngreso') }}",
                icon: "error"
            });
        </script>  
    @endif

    @if (Session::has('resEliminarReqFecha'))
        <script>
            Swal.fire({
                title: "Informacion",
                text: "{{ session('resEliminarReqFecha') }}",
                icon: "success"
            });
        </script>  
    @endif

    @if (Session::has('resErrorEliminarReqFecha'))
        <script>
            Swal.fire({
                title: "Informacion",
                text: "{{ session('resErrorEliminarReqFecha') }}",
                icon: "error"
            });
        </script>  
    @endif
    
@endsection