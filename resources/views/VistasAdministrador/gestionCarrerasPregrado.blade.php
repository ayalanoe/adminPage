@extends('Layouts.dashboard')
@section('titulo', '- Planes de Estudio')

@section('contenido')

    <div class="container">
        <h2>Carreras de Pregrado</h2>

    </div>

    <div class="container">
        <button type="submit" class="btn btn-success mx-1" data-bs-toggle="modal" data-bs-target="#ModalAgregarCarreraPregrado"><i class="fa-solid fa-plus"></i> Agregar Carrera PreGrado</button>
    </div>
    

    <div class="modal fade" id="ModalAgregarCarreraPregrado" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
    
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Registro de carrera de pregrado</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
    
                    <form action="{{ route("carreraPregradoIngresar") }}" enctype="multipart/form-data" method="POST" class="row g-3 needs-validation" novalidate>
                        @csrf

                        <div class="col-md-12">
                            <label for="validationCustomUser" class="form-label">Tipo de Carrera</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-bars"></i></span>
                                <input name="tipoCarreraPregrado" type="text" class="form-control" id="validaUser" value="Carrera_Pregrado" readonly> <!-- La propiedad readonly permite que el input sea solo de lectura ya que disable no envia el valor del input y el objetivo es que esté deshabilitado pero que se envíe -->
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label for="validationCustomUser" class="form-label">Nombre de la carrera</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-pen-to-square"></i></span>
                                <input name="namePregradoCarrera" type="text" class="form-control" id="validaUser" required>
                                <div class="valid-feedback">
                                    Carrera invalida!
                                </div>
                            </div>
                        </div>
                                    
                        <div class="col-md-12">
                            <label for="validationCustomCorreo" class="form-label">Codigo de la carrera</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-file-lines"></i></span>
                                <input name="codigoCarreraPregrado" type="text" class="form-control" id="validaCorreo" aria-describedby="inputGroupPrepend" required>
                                <div class="invalid-feedback">
                                    Codigo no valido!
                                </div>
                            </div>
                        </div>
            
                        <div class="col-md-12">
                            <label for="validationCustomCorreo" class="form-label">Departamento</label>
                            <input name="departamentoCarreraPregrado" class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Buscar Departmento...">
                            <datalist id="datalistOptions">
                                <option value="Ingeniería y Arquitectura">
                                <option value="Medicina">
                                <option value="Ciencias y Humanidades">
                                <option value="Jurisprudencia y Ciencias Sociales">
                                <option value="Ciencias Económicas">
                                <option value="Ciencias Naturales y Matemáticas">
                                <option value="Ciencias Agronómicas">
                                <option value="Química y Farmacia">
                                <option value="PostGrado"></option>
                                <option value="Carreras Técnicas"></option>
                            </datalist>
                        </div>
            
                        <div class="col-md-12">
                            <label for="validationCustomCorreo" class="form-label">Cargar archivo del plan de estudio</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text" id="inputGroupPrepend"><i class="fa-regular fa-file"></i></span>
                                <input name="archivoPregradoCarrera" accept=".pdf, .jpg, .jpeg, .png" type="file" class="form-control" aria-describedby="inputGroupPrepend" required>
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

@if (Session::has('resCarreraPregrado'))
    <script>
        Swal.fire({
            title: "Informacion",
            text: "{{ session('resCarreraPregrado') }}",
            icon: "success"
        });
    </script>  
@endif
    
@endsection