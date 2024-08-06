@extends('Layouts.dashboard')
@section('titulo', '- Tipos de Ingreso')

@section('contenido')

    <div class="container">
        <h2 class="global-tittle">GESTIÓN DE TIPOS DE INGRESO</h2>
        <hr>

        @if ($newIngresoTipos->isEmpty())

            <div class="alert alert-warning">
                No hay registro
            </div>

        @else
            @php
                $numero = 1
            @endphp
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tipo de Ingreso</th>
                        <th scope="col">Fecha publicación</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($newIngresoTipos as $tipoIngreso)
                        <tr>
                            <th scope="row">{{$numero}}</th>  
                            <td>{{$tipoIngreso->titulo}}</td>
                            <td>{{ date('d-m-Y', strtotime($tipoIngreso->fechaPublicacion)) }}</td>

                            <td class="d-flex">
                                <form action="{{route('eliminarTipoIngreso', $tipoIngreso->id)}}" class="formEliminarIngreso" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger mx-1"><i class="fa-solid fa-trash"></i></button>
                                </form>

                                <a href="{{ route('vistaEditarIngresoTipo', $tipoIngreso->id) }}" class="btn btn-primary mx-1">
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

    @if ($newIngresoTipos->isEmpty() || $newIngresoTipos->count() < 4)
        <!-- Bton para poder insertar un nuevo tipo de ingreso -->
        <div class="container">
            <a href="{{ route('crearTipoIngreso') }}" class="btn btn-success mx-1"><i class="fa-solid fa-plus"></i> Agregar Tipo de Ingreso</a>
        </div>
        
    @endif
    
@endsection

@section('jsVistasAdmin')

    <script>
        $('.formEliminarIngreso').on('submit', function(e){
            e.preventDefault();

            Swal.fire({
                title: "¿Está seguro?",
                text: "Se eliminará el tipo de ingreso",
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

    @if (Session::has('resGuardarTipoIngreso'))
        <script>
            Swal.fire({
                title: "Informacion",
                text: "{{ session('resGuardarTipoIngreso') }}",
                icon: "success"
            });
        </script>  
    @endif

    @if (Session::has('resEliminarTipoIngreso'))
        <script>
            Swal.fire({
                title: "Informacion",
                text: "{{ session('resEliminarTipoIngreso') }}",
                icon: "success"
            });
        </script>  
    @endif

    @if (Session::has('resEditarTipoIngreso'))
        <script>
            Swal.fire({
                title: "Informacion",
                text: "{{ session('resEditarTipoIngreso') }}",
                icon: "success"
            });
        </script>  
    @endif

    @if (Session::has('resErrorTipoIngreso'))
        <script>
            Swal.fire({
                title: "Informacion",
                text: "{{ session('resErrorTipoIngreso') }}",
                icon: "error"
            });
        </script>  
    @endif
    
@endsection