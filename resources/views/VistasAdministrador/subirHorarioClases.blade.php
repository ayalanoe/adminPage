<!-- resources/views/subir_archivo.blade.php -->
@extends('Layouts.dashboard')

@section('titulo', '- Horario De Clases')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/cssAdministrador/estiloSubirHorario.css')}}">   
@endsection

@section('contenido')
        
    <h2>Horario de Clases</h2>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre del archivo</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>

        <tbody>
            @php
                $numero = 1 
            @endphp

            @forelse ($horario as $horarioClase)
                <tr>
                    <th scope="row">{{$numero}}</th>  
                    <td>{{$horarioClase->nombreArchivo}}</td>
                    <td>

                        @if ($horarioClase->rutaArchivo)
                            <form class="fluid" action="{{route('eliminarHorarioAcademico', $horarioClase->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                            </form>
                                
                            <a href="{{ route('contenidoCalendarioAcademico', $horarioClase->id) }}" class="btn btn-secondary" target="_blank"><i class="fa-solid fa-eye"></i></a>
                        @endif
                        
                    </td>
                </tr>
                @php
                    $numero++
                @endphp

                @empty
                <tr>
                    <th>1</th>
                    <td>Subir calendario académico</td>
                    <td colspan="3">
                        <a class="btn btn-secondary" href="calendarioAcademico" data-bs-toggle="modal" data-bs-target="#subirCalendarioAcademico"><i class="fa-sharp fa-solid fa-upload"></i></a>
                    </td>
                </tr>

            @endforelse
        </tbody>
    </table>

    @if (Session::has('resCalendarioAcademico'))
        <script>
            Swal.fire({
                title: "Informacion",
                text: "{{ session('resCalendarioAcademico') }}",
                icon: "success"
            });
        </script>
    @endif

@endsection

@section('modales')

    <!-- Modal para subir el calendario academico -->
    <div class="modal fade" id="subirCalendarioAcademico" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Subir calendario académico</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    

                    <form action="{{route('guardar-archivo')}}" method="POST" enctype="multipart/form-data" class="row g-3 needs-validation" novalidate>
                        @csrf

                        <div class="col-md-12">
                            <label for="validationCustomUser" class="form-label">Nombre Archivo</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-t"></i></span>
                                <input name="nombreArchivo" type="text" class="form-control" id="nombreCalendarioAcademico" required>
                                <div class="valid-feedback">
                                    Nombre valido!
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <label for="validationCustomCorreo" class="form-label">Cargar archivo</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text" id="inputGroupPrepend"><i class="fa-regular fa-file"></i></span>
                                <input name="archivo" accept=".pdf, .jpg, .jpeg, .png" type="file" class="form-control" aria-describedby="inputGroupPrepend" required>
                                <div class="invalid-feedback">
                                    Seleccione un archivo
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Subir archivo</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection

