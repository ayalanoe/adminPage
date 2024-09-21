@extends('Layouts.dashboard')
@section('titulo', '- Preguntas Frecuentes')

@section('contenido')

    <div class="container">
        <h2 class="global-tittle">GESTIÓN DE PREGUNTAS FRECUENTES</h2>
        <hr>
        <!-- Bton para poder insertar una carrera de pregrado -->
        <div class="container">
            <a href="{{ route('vistaIngresarPregunta') }}" class="btn btn-success mx-1"><i class="fa-solid fa-plus"></i> Agregar Pregunta Frecuente</a>
        </div>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Pregunta</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $numero = 1 
                @endphp
        
                @foreach ($preguntasFrecuentes as $pregunta)
                <tr>
                    <th scope="row">{{$numero}}</th>  
                    <td>{{$pregunta->pregunta}}</td>

                    <td class="d-flex">
        
                        <form action="{{ route('eliminarPreguntaFrecuente', $pregunta->id) }}" class="formEliminarPregunta" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger mx-1"><i class="fa-solid fa-trash"></i></button>
                        </form> 
                        
                        <a href="{{ route('editarPreguntaVista', $pregunta->id) }}" class="btn btn-primary mx-1">
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
        $('.formEliminarPregunta').on('submit', function(e){
            e.preventDefault();

            Swal.fire({
                title: "¿Está seguro?",
                text: "Se eliminará la pregunta",
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

    @if (Session::has('resCrearPregunta'))
        <script>
            Swal.fire({
                title: "Informacion",
                text: "{{ session('resCrearPregunta') }}",
                icon: "success"
            });
        </script>  
    @endif

    @if (Session::has('resEliminarPregunta'))
        <script>
            Swal.fire({
                title: "Informacion",
                text: "{{ session('resEliminarPregunta') }}",
                icon: "success"
            });
        </script>  
    @endif

    @if (Session::has('resEditarPregunta'))
        <script>
            Swal.fire({
                title: "Informacion",
                text: "{{ session('resEditarPregunta') }}",
                icon: "success"
            });
        </script>  
    @endif
    
@endsection