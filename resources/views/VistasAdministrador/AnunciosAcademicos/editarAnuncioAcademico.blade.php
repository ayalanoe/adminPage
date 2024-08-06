@extends('Layouts.dashboard')
@section('titulo', '- Editar Anuncio')

@section('contenido')

    <div class="container">
        <h2 class="global-tittle">EDITAR ANUNCIO ACADÉMICO</h2>
        <hr>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Archivo del anuncio</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @php
                $numero = 1 
                @endphp

                <th scope="row">{{$numero}}</th>  
                @if ($anuncioEditar->rutaArchivo)
                    <td>Imagen_Informativa</td>
                    <td class="d-flex">
                        <form action="{{ route('eliminarArchivoAnuncio', $anuncioEditar->id) }}" class="formElminarArchivoAnuncio" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger mx-1"><i class="fa-solid fa-trash"></i></button>
                        </form> 

                        <a href="{{ route('verArchivoAnuncio', $anuncioEditar->id) }}" class="btn btn-primary mx-1" target="_blank"><i class="fa-solid fa-eye"></i></a>
                    </td>
                @else
                    <td>Subir una imagen informativa. *OPCIONAL !</td>
                    <td class="d-flex">  
                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalNuevoArchivoAnuncio"><i class="fa-sharp fa-solid fa-upload"></i></button>
                    </td>
                @endif
            
            </tbody>
        </table>


        <form action="{{ route('nuevosDatosAnuncio', $anuncioEditar->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Título del anuncio</label>
                <input value="{{$anuncioEditar->titulo}}" name="editarTituloAnuncio" type="text" class="form-control" id="exampleFormControlInput1" required>
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Fecha de expiración</label>
                <input value="{{$anuncioEditar->fechaExpiracion}}" name="editarFechaExpiracion" type="date" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" style="width: 200px;" required>
            </div>        

            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Contenido del anuncio</label>
                <textarea name="editarCuerpoAnuncio" id="editor" cols="30" rows="50">{{$anuncioEditar->cuerpo}}</textarea>

                <script>
                    ClassicEditor
                        .create( document.querySelector( '#editor' ) )
                        .catch( error => {
                            console.error( error );
                        });
                </script>
                
            </div>

            <div class="mb-3">
                <a href="{{ route('cancelarEditAnuncio') }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            </div>

        </form>

    </div>


    <!------------- Modal para subir el archivo pdf nuevamente el pdf del plan de estudio de la carrera de pregrado -->
    <div class="modal fade" id="modalNuevoArchivoAnuncio" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
    
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Subir una imagen para el anuncio</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <form action="{{ route('nuevaImagenAnuncio', $anuncioEditar->id) }}" enctype="multipart/form-data" method="POST" class="row g-3 needs-validation" novalidate>
                        @csrf

                        <div class="col-md-12">
                            <label for="validationCustomCorreo" class="form-label">Cargar imagen</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text" id="inputGroupPrepend"><i class="fa-regular fa-file"></i></span>
                                <input name="editarArchivoAnuncio" accept=".jpg, .jpeg, .png" type="file" class="form-control" aria-describedby="inputGroupPrepend" required>
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
        $('.formElminarArchivoAnuncio').on('submit', function(e){
            e.preventDefault();

            Swal.fire({
                title: "¿Está seguro?",
                text: "Se eliminará el archivo del anuncio",
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

    @if (Session::has('resSubirArchivoAnuncio'))
    <script>
        Swal.fire({
            title: "Informacion",
            text: "{{ session('resSubirArchivoAnuncio') }}",
            icon: "success"
        });
    </script>  
    @endif

    @if (Session::has('resEliminarArchivoAnuncio'))
    <script>
        Swal.fire({
            title: "Informacion",
            text: "{{ session('resEliminarArchivoAnuncio') }}",
            icon: "success"
        });
    </script>  
    @endif
    
@endsection
