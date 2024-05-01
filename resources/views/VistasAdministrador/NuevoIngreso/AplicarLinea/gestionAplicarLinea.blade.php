@extends('Layouts.dashboard')
@section('titulo', '- Aplicar en Linea')

@section('contenido')

    <div class="container">

        <h2>Información para Aplicar en Línea</h2>

        @if ($datosAplyEnLinea->isEmpty())
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

                    @foreach ($datosAplyEnLinea as $aplicar)
                        <tr>
                            <th scope="row">{{$numero}}</th>  
                            <td>{{$aplicar->titulo}}</td>
                            <td>{{ date('d-m-Y', strtotime($aplicar->fechaPublicacion)) }}</td>

                            <td class="d-flex">
                                <form action="{{route('aplicarEnLineaEliminar', $aplicar->id)}}" class="formEliminarAplicarEnLinea" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger mx-1"><i class="fa-solid fa-trash"></i></button>
                                </form>

                                <a href="{{ route('vistaEditarAplyLinea', $aplicar->id)}}" class="btn btn-primary mx-1">
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

    @if ($datosAplyEnLinea->isEmpty())
        <div class="container">
            <a href="{{ route('infoAplicarLinea') }}" class="btn btn-success mx-1"><i class="fa-solid fa-plus"></i> Registrar información</a>
        </div>
    @endif
    
    
    
@endsection

@section('jsVistasAdmin')

    <script>
        $('.formEliminarAplicarEnLinea').on('submit', function(e){
            e.preventDefault();

            Swal.fire({
                title: "¿Está seguro?",
                text: "Se eliminará el registro de aplicar en línea",
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

    @if (Session::has('resGuardarAplyLinea'))
        <script>
            Swal.fire({
                title: "Informacion",
                text: "{{ session('resGuardarAplyLinea') }}",
                icon: "success"
            });
        </script>  
    @endif

    @if (Session::has('errorRegistroAplyLinea'))
        <script>
            Swal.fire({
                title: "Informacion",
                text: "{{ session('errorRegistroAplyLinea') }}",
                icon: "error"
            });
        </script>  
    @endif

    @if (Session::has('resEliminarAplicarEnLinea'))
        <script>
            Swal.fire({
                title: "Informacion",
                text: "{{ session('resEliminarAplicarEnLinea') }}",
                icon: "success"
            });
        </script>  
    @endif

    @if (Session::has('resEditApliLinea'))
        <script>
            Swal.fire({
                title: "Informacion",
                text: "{{ session('resEditApliLinea') }}",
                icon: "success"
            });
        </script>  
    @endif
    
@endsection