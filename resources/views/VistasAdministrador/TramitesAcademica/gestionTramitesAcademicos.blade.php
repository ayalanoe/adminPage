@extends('Layouts.dashboard')
@section('titulo', '- Tramites Academicos')

@section('contenido')

    <div class="container">
        <h2 class="global-tittle">GESTIÓN DE TRÁMITES ACADÉMICOS</h2>
        <hr>
        <!-- Bton para poder insertar una carrera de pregrado -->
        <div class="container">
            <a href="{{ route('crearTramiteAcademico') }}" class="btn btn-success mx-1"><i class="fa-solid fa-plus"></i> Agregar Tramite Academico</a>
        </div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tramite Académico</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $numero = 1 
                @endphp
        
                @foreach ($datosTramites as $tramite)
                <tr>
                    <th scope="row">{{$numero}}</th>  
                    <td>{{$tramite->tramite}}</td>

                    <td class="d-flex">
        
                        <form action="{{ route('eliminarTramite', $tramite->id) }}" class="formEliminarTramite" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger mx-1"><i class="fa-solid fa-trash"></i></button>
                        </form> 
                        
                        <a href="{{ route('editarTramite', $tramite->id)}}" class="btn btn-primary mx-1">
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
    
@endsection

@section('jsVistasAdmin')

    <script>
        $('.formEliminarTramite').on('submit', function(e){
            e.preventDefault();

            Swal.fire({
                title: "¿Está seguro?",
                text: "Se eliminará el trámite",
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

    @if (Session::has('resCrearTramite'))
        <script>
            Swal.fire({
                title: "Informacion",
                text: "{{ session('resCrearTramite') }}",
                icon: "success"
            });
        </script>  
    @endif

    @if (Session::has('resEliminarTramite'))
        <script>
            Swal.fire({
                title: "Informacion",
                text: "{{ session('resEliminarTramite') }}",
                icon: "success"
            });
        </script>  
    @endif

    @if (Session::has('resEditarTramite'))
        <script>
            Swal.fire({
                title: "Informacion",
                text: "{{ session('resEditarTramite') }}",
                icon: "success"
            });
        </script>  
    @endif
    
@endsection