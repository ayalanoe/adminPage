@extends('Layouts.dashboard')
@section('titulo', '- Planes de Estudio')

@section('contenido')

    <div class="container">
        <h2>Carreras de Posgrado</h2>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Carrera</th>
                    <th scope="col">Codigo_Carrera</th>
                    <th scope="col">Tipo_Carrera</th>
                    <th scope="col">Departamento</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $numero = 1 
                @endphp
        
                @foreach ($carrerasPosgrado as $carrera)
                <tr>
                    <th scope="row">{{$numero}}</th>  
                    <td>{{$carrera->carrera}}</td>
                    <td>{{$carrera->codigoCarrera}}</td>
                    <td>{{$carrera->tipoCarrera}}</td>
                    <td>{{$carrera->departamento}}</td><!--Actualizar agregando campo tramites-->
                    <td class="d-flex">
        
                        <form action="{{ route('eliminarCarreraPosgrado', $carrera->id) }}" class="formEliminarCarreraPosgrado" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger mx-1"><i class="fa-solid fa-trash"></i></button>
                        </form> 
                        
                        <a href="{{ route('editarCarreraPosgrado', $carrera->id)}}" class="btn btn-primary mx-1">
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

    <!-- Bton para poder insertar una carrera de pregrado -->
    <div class="container">
        <button type="submit" class="btn btn-success mx-1" data-bs-toggle="modal" data-bs-target="#ModalAgregarCarreraPosgrado"><i class="fa-solid fa-plus"></i> Agregar Carrera Posgrado</button>
    </div>

    <div class="modal fade" id="ModalAgregarCarreraPosgrado" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
    
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Registro de carrera de posgrado</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
    
                    <form action="{{ route("carreraPosgradoIngresar") }}" enctype="multipart/form-data" method="POST" class="row g-3 needs-validation" novalidat>
                        @csrf

                        <div class="col-md-12">
                            <label for="validationCustomUser" class="form-label">Tipo de Carrera</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-bars"></i></span>
                                <input name="tipoCarreraPosgrado" type="text" class="form-control" value="Carrera_Posgrado" readonly> <!-- La propiedad readonly permite que el input sea solo de lectura ya que disable no envia el valor del input y el objetivo es que esté deshabilitado pero que se envíe -->
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label for="validationCustomUser" class="form-label">Nombre de la carrera</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-pen-to-square"></i></span>
                                <input name="namePosgradoCarrera" type="text" class="form-control" required>
                                <div class="valid-feedback">
                                    Carrera invalida!
                                </div>
                            </div>
                        </div>
                                    
                        <div class="col-md-12">
                            <label for="validationCustomCorreo" class="form-label">Codigo de la carrera</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-file-lines"></i></span>
                                <input name="codigoCarreraPosgrado" type="text" class="form-control" id="validaCorreo" aria-describedby="inputGroupPrepend" required>
                                <div class="invalid-feedback">
                                    Codigo no valido!
                                </div>
                            </div>
                        </div>
            
                        <div class="col-md-12">
                            <label for="validationCustomCorreo" class="form-label">Departamento</label>
                            <input name="departamentoCarreraPosgrado" class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Buscar Departmento...">
                            <datalist id="datalistOptions">
                                <option value="Ingeniería y Arquitectura">
                                <option value="Medicina">
                                <option value="Ciencias y Humanidades">
                                <option value="Jurisprudencia y Ciencias Sociales">
                                <option value="Ciencias Económicas">
                                <option value="Ciencias Naturales y Matemáticas">
                                <option value="Ciencias Agronómicas">
                                <option value="Química y Farmacia">
                                <option value="Posgrado">
                                <option value="Carreras Técnicas">
                            </datalist>
                        </div>
            
                        <div class="col-md-12">
                            <label for="validationCustomCorreo" class="form-label">Cargar archivo del plan de estudio</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text" id="inputGroupPrepend"><i class="fa-regular fa-file"></i></span>
                                <input name="archivoPosgradoCarrera" accept=".pdf, .jpg, .jpeg, .png" type="file" class="form-control" aria-describedby="inputGroupPrepend" required>
                                <div class="invalid-feedback">
                                    Seleccione un archivo
                                </div>
                            </div>
                        </div>
            
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Registrar carrera</button>
                        </div>
        
                    </form>
    
                </div> 
            </div>
        </div>
    </div>
    
@endsection

@section('jsVistasAdmin')

    <!-- Para preguntar si está de acuerdo con eliminar la carrera -->
    <script>
        $('.formEliminarCarreraPosgrado').on('submit', function(e){
            e.preventDefault();

            Swal.fire({
                title: "¿Está seguro?",
                text: "Se eliminará la carrera",
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
    
    @if (Session::has('resCarreraPosgrado'))
        <script>
            Swal.fire({
                title: "Informacion",
                text: "{{ session('resCarreraPosgrado') }}",
                icon: "success"
            });
        </script>  
    @endif

    @if (Session::has('resUpdateCarrPos'))
    <script>
        Swal.fire({
            title: "Informacion",
            text: "{{ session('resUpdateCarrPos') }}",
            icon: "success"
        });
    </script>  
    @endif

    @if (Session::has('resEliminarCarreraPosgrado'))
        <script>
            Swal.fire({
                title: "Informacion",
                text: "{{ session('resEliminarCarreraPosgrado') }}",
                icon: "success"
            });
        </script>  
    @endif
    
@endsection