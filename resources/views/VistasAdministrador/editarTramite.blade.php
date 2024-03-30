@extends('Layouts.dashboard')
@section('titulo', '- Editar Tramite')

@section('contenido')

    <div class="container">

        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Formato del tramite</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @php
                $numero = 1 
                @endphp

                <th scope="row">{{$numero}}</th>  
                @if ($datosTramiteEditar->rutaFormato)
                    <td>Formato_Cargado</td>
                    <td class="d-flex">
                        <form action="{{ route('eliminarArchivoTramite', $datosTramiteEditar->id)}}" enctype="multipart/form-data" class="formEliminarFormatoTramite" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger mx-1"><i class="fa-solid fa-trash"></i></button>
                        </form> 

                        @php
                            $extension = strtolower(pathinfo($datosTramiteEditar->rutaFormato, PATHINFO_EXTENSION));
                        @endphp

                        @if (in_array($extension, ['doc', 'docx']))
                            <a href="{{ route('descargarFormatoTramite', $datosTramiteEditar->id)}}" class="btn btn-success mx-1" target="_blank"><i class="fa-solid fa-file-arrow-down"></i></a>   
                        @else
                            <a href="{{ route('verArchivoTramite', $datosTramiteEditar->id)}}" class="btn btn-primary mx-1" target="_blank"><i class="fa-solid fa-eye"></i></a>
                        @endif
                    </td>
                @else
                    <td>Subir formato para el tramite</td>
                    <td class="d-flex">  
                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalNuevoFormatoTramite"><i class="fa-sharp fa-solid fa-upload"></i></button>
                    </td>
                @endif
            
            </tbody>
        </table>



        <!-- Parte del form para editar los datos --> 
        <form class="formEditarTramite" action="{{ route('guardarNuevosDatosTramite', $datosTramiteEditar->id)}}" method="POST">
            @csrf
            
            <div class="col-md-12">
                <label for="validationCustomUser" class="form-label">Trámite</label>
                <div class="input-group has-validation">
                    <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-bars"></i></span>
                    <input id="nombreTramite" name="editarTramite" type="text" class="form-control" value="{{$datosTramiteEditar->tramite}}"> <!-- La propiedad readonly permite que el input sea solo de lectura ya que disable no envia el valor del input y el objetivo es que esté deshabilitado pero que se envíe -->
                </div>
            </div>

            <br>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Contenido tramite</label>
                <textarea name="editarContenidoTramite" id="editor" cols="30" rows="50"> {{$datosTramiteEditar->contenido}} </textarea>

                <script>
                    ClassicEditor
                        .create( document.querySelector( '#editor' ) )
                        .catch( error => {
                            console.error( error );
                        } );
                </script>
                
            </div>

            <br>
            <a href="{{ route('verTramitesAcademicos') }}" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>

        </form>

    </div>

    <!-- Modal para poder subir el formato ------------------->
    <div class="modal fade" id="modalNuevoFormatoTramite" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
    
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Subir nuevo formato tramite</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <form action="{{ route('nuevoArchivoTramite', $datosTramiteEditar->id)}}" enctype="multipart/form-data" method="POST" class="row g-3 needs-validation" novalidate>
                        @csrf

                        <div class="col-md-12">
                            <label for="validationCustomCorreo" class="form-label">Cargar Archivo</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text" id="inputGroupPrepend"><i class="fa-regular fa-file"></i></span>
                                <input name="editarNuevoFormatoTramite" accept=".pdf, .jpg, .jpeg, .png" type="file" class="form-control" aria-describedby="inputGroupPrepend" required>
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

@section('jsVistasAdmin')

    <script>
        $('.formEliminarFormatoTramite').on('submit', function(e){
            e.preventDefault();

            Swal.fire({
                title: "¿Está seguro?",
                text: "Se eliminará el formato",
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


    @if (Session::has('resSubirArchivoTramite'))
    <script>
        Swal.fire({
            title: "Información",
            text: "{{ session('resSubirArchivoTramite') }}",
            icon: "success"
        });
    </script>  
    @endif

    @if (Session::has('resEliminarArchivoTramite'))
    <script>
        Swal.fire({
            title: "Información",
            text: "{{ session('resEliminarArchivoTramite') }}",
            icon: "success"
        });
    </script>  
    @endif

    <script>
        $('.formEditarTramite').on('submit', function(e) {

            var tramiteNombreEdit = $('#nombreTramite').val().trim();
            var tramiteContenidoEdit = $('#editor').val().trim();

            if (tramiteNombreEdit === "" || tramiteContenidoEdit === "") {
                e.preventDefault(); // evita el envío del formulario si hay campos vacíos

                Swal.fire({
                    title: "Campos vacíos",
                    text: "Rellene todos los campos",
                    icon: "error"
                });
            }
        });
    </script>
    
@endsection