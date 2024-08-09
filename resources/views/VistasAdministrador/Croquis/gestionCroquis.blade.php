@extends('Layouts.dashboard')

@section('titulo', '- Croquis')

@section('contenido')
    
    <div class="container">

        <h2 class="global-tittle">CROQUIS FMO</h2>
        <hr>
        <br>
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
    
                @forelse ($croq as $informacion)
                    <tr>
                        <th scope="row">{{$numero}}</th>  
                        <td>{{$informacion->nombreArchivo}}</td>
                        <td class="d-flex">
                            @if ($informacion->rutaArchivo)
                                <form id="formEliminarCroquis" class="fluid" action="{{ route('deleteCroquis', $informacion->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger mx-1"><i class="fa-solid fa-trash"></i></button>
                                </form>
                                    
                                <a href="{{ route('mostrarCroquis', $informacion->id)}}" class="btn btn-secondary mx-1" target="_blank"><i class="fa-solid fa-eye"></i></a>
                            @endif
                        </td>
                    </tr>
                    @php
                        $numero++
                    @endphp
    
                    @empty
                    <tr>
                        <th>1</th>
                        <td>Subir croquis</td>
                        <td colspan="3">
                            <a class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#subirCroquis"><i class="fa-sharp fa-solid fa-upload"></i></a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>

    



    @if (Session::has('resSubirCroquis'))
        <script>
            Swal.fire({
                title: "Informacion",
                text: "{{ session('resSubirCroquis') }}",
                icon: "success"
            });
        </script>
    @endif


    @if (Session::has('resEliminarCroquis'))
        <script>
            Swal.fire({
                title: "Informacion",
                text: "{{ session('resEliminarCalAdmin') }}",
                icon: "success"
            });
        </script>
    @endif

@endsection

@section('jsVistasAdmin')

    <script>

        $('#formEliminarCroquis').on('submit', function(e){
            
            e.preventDefault();
            Swal.fire({
                title: "¿Está seguro?",
                text: "Se eliminará el Croquis de la FMO",
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


@section('modales')

    <!-- Modal para subir el PDF del croquis -->
    <div class="modal fade" id="subirCroquis" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Subir Croquis FMO</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    

                    <form action="{{route('enviarCroquis')}}" method="POST" enctype="multipart/form-data" class="row g-3 needs-validation" novalidate>
                        @csrf

                        <div class="col-md-12">
                            <label for="validationCustomUser" class="form-label">Nombre Archivo</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-t"></i></span>
                                <input name="nombreArchivo" type="text" class="form-control" id="nombreCroquisFMO" required>
                                <div class="invalid-feedback">
                                    Escriba un nombre!
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <label for="validationCustomCorreo" class="form-label">Cargar archivo</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text" id="inputGroupPrepend"><i class="fa-regular fa-file"></i></span>
                                <input name="archivo" accept=".pdf" type="file" class="form-control" aria-describedby="inputGroupPrepend" required>
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

