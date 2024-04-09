@extends('Layouts.dashboard')
@section('titulo', '- Editar Carrera')

@section('contenido')

    <div class="container">

        <h2>Editar Carrera de posgrado</h2>

        <br>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Plan de estudio</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @php
                $numero = 1 
                @endphp

                <th scope="row">{{$numero}}</th>  
                @if ($carreraPosgradoEdit->estadoArchivo)
                    <td>Archivo_Cargado</td>
                    <td class="d-flex">
                        <form action="{{ route('eliminarPdfCarreraPosgrado', $carreraPosgradoEdit->id)}} " class="formEliminarPdfCarPos" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger mx-1"><i class="fa-solid fa-trash"></i></button>
                        </form> 
                        <a href="{{ route('verPlanCarrPos', $carreraPosgradoEdit->id) }}" class="btn btn-primary mx-1" target="_blank"><i class="fa-solid fa-eye"></i></a>
                    </td>
                @else
                    <td>Favor subir el plan de estudio</td>
                    <td class="d-flex">  
                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalAddNuevoPlanCarPos"><i class="fa-sharp fa-solid fa-upload"></i></button>
                    </td>
                @endif
            
            </tbody>
        </table>

        <form action="{{ route('guardarNuevosDatosCarrPos', $carreraPosgradoEdit->id) }}" class="formEnviarNewPlanPosgrado" method="POST">
            @csrf
            
            <div class="col-md-12">
                <label for="validationCustomUser" class="form-label">Tipo de Carrera</label>
                <div class="input-group has-validation">
                    <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-bars"></i></span>
                    <input name="editarTipoCarreraPos" type="text" class="form-control" id="validaUser" value="Carrera_Posgrado" readonly> <!-- La propiedad readonly permite que el input sea solo de lectura ya que disable no envia el valor del input y el objetivo es que esté deshabilitado pero que se envíe -->
                </div>
            </div>

            <br>
            <div class="col-md-12">
                <label for="validationCustomUser" class="form-label">Nombre de la carrera</label>
                <div class="input-group has-validation">
                    <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-pen-to-square"></i></span>
                    <input value="{{$carreraPosgradoEdit->carrera}}" name="editarNombreCarreraPos" type="text" class="form-control" id="nombreCarreraPosgrado">
                    <div class="valid-feedback">
                        Carrera invalida!
                    </div>
                </div>
            </div>
            
            
            <br>
            <div class="col-md-12">
                <label for="validationCustomCorreo" class="form-label">Codigo de la carrera</label>
                <div class="input-group has-validation">
                    <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-file-lines"></i></span>
                    <input value="{{$carreraPosgradoEdit->codigoCarrera}}" name="editarCodigoCarreraPos" type="text" class="form-control" id="codigoCarreraPosgrado" aria-describedby="inputGroupPrepend">
                    <div class="invalid-feedback">
                        Codigo no valido!
                    </div>
                </div>
            </div>

            <br>
            <div class="col-md-12">
                <label for="validationCustomCorreo" class="form-label">Departamento</label>
                <input value="{{$carreraPosgradoEdit->departamento}}" name="editarDeptoCarreraPos" class="form-control" list="datalistOptions" id="deptoCarreraPosgrado">
                <datalist id="datalistOptions">
                    <option value="EPOS" label="Posgrado"></option>
                </datalist>
            </div>

            <br>
            <a href="{{ route('cancelarCarrPos') }}" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
        
    </div>


    <!------------- Modal para subir el archivo pdf nuevamente el pdf del plan de estudio de la carrera de pregrado -->
    <div class="modal fade" id="modalAddNuevoPlanCarPos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
    
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Subir pdf del plan de estudio</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form action="{{ route('nuevoPlanCarrPosgado', $carreraPosgradoEdit->id) }}" enctype="multipart/form-data" method="POST" class="row g-3 needs-validation" novalidate>
                        @csrf

                        <div class="col-md-12">
                            <label for="validationCustomCorreo" class="form-label">Cargar archivo del plan de estudio</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text" id="inputGroupPrepend"><i class="fa-regular fa-file"></i></span>
                                <input name="editNewPlanCarPos" accept=".pdf" type="file" class="form-control" aria-describedby="inputGroupPrepend" required>
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
        //Validacion de que los campos no estén vacios
        $('.formEnviarNewPlanPosgrado').on('submit', function(e) {

            var posgradoCarNombre = $('#nombreCarreraPosgrado').val().trim();
            var posgradoCarCodigo = $('#codigoCarreraPosgrado').val().trim();
            var posgradoCarDepto = $('#deptoCarreraPosgrado').val().trim();

            if (posgradoCarNombre === "" || posgradoCarCodigo === "" || posgradoCarDepto === "") {
                e.preventDefault(); // evita el envío del formulario si hay campos vacíos

                Swal.fire({
                    title: "Campos vacíos",
                    text: "Rellene todos los campos",
                    icon: "error"
                });
            }
        });
    </script>

    <script>

        $('.formEliminarPdfCarPos').on('submit', function(e){
            e.preventDefault();

            Swal.fire({
                title: "¿Está seguro?",
                text: "Se eliminará la el pdf",
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

    @if (Session::has('resEliminarPdfCarPos'))
        <script>
            Swal.fire({
                title: "Información",
                text: "{{ session('resEliminarPdfCarPos') }}",
                icon: "success"
            });
        </script>  
    @endif

    @if (Session::has('resSubirNewPlanCarrPos'))
        <script>
            Swal.fire({
                title: "Información",
                text: "{{ session('resSubirNewPlanCarrPos') }}",
                icon: "success"
            });
        </script>  
    @endif

    @if (Session::has('resSinArchivoCarrePos'))
        <script>
            Swal.fire({
                title: "Información",
                text: "{{ session('resSinArchivoCarrePos') }}",
                icon: "error"
            });
        </script>  
    @endif

    
@endsection