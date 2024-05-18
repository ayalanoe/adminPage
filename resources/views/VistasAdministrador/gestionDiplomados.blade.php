@extends('Layouts.dashboard')
@section('titulo', '- Diplomados')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/cssAdministrador/textoGestionGlobal.css') }}">   
@endsection
@section('contenido')

    <div class="container">
        <h2>Diplomados impartidos</h2>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Diplomado</th>
                    <th scope="col">Codigo Diplomado</th>
                    <th scope="col">Tipo_Carrera</th>
                    <th scope="col">Departmento</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $numero = 1 
                @endphp
        
                @foreach ($listadoDiplomados as $diplomado)
                <tr>
                    <th scope="row">{{$numero}}</th>  
                    <td>{{$diplomado->carrera}}</td>
                    <td>{{$diplomado->codigoCarrera}}</td>
                    <td>{{$diplomado->tipoCarrera}}</td>
                    <td>{{$diplomado->departamento}}</td><!--Actualizar agregando campo tramites-->
                    <td class="d-flex">
        
                        <form action="{{ route('diplomadoEliminar', $diplomado->id) }}" class="formEliminarDiplomado" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger mx-1"><i class="fa-solid fa-trash"></i></button>
                        </form> 
                        
                        <a href="{{route('vistaEditarDiplomado', $diplomado->id) }}" class="btn btn-primary mx-1">
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

    <!-- Bton para poder insertar un diplomado -->
    <div class="container">
        <button type="submit" class="btn btn-success mx-1" data-bs-toggle="modal" data-bs-target="#modalAgregarDiplomado"><i class="fa-solid fa-plus"></i> Agregar Diplomado</button>
    </div>

    <div class="modal fade" id="modalAgregarDiplomado" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
    
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Registro de carrera de posgrado</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
    
                    <form action="{{ route('ingresarDiplomado') }}" enctype="multipart/form-data" method="POST" class="row g-3 needs-validation" novalidat>
                        @csrf

                        <div class="col-md-12">
                            <label for="validationCustomUser" class="form-label">Tipo de Carrera</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-bars"></i></span>
                                <input name="tipoCarreraDiplomado" type="text" class="form-control" value="Diplomado" readonly> <!-- La propiedad readonly permite que el input sea solo de lectura ya que disable no envia el valor del input y el objetivo es que esté deshabilitado pero que se envíe -->
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label for="validationCustomUser" class="form-label">Nombre del diplomado</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-pen-to-square"></i></span>
                                <input name="nombreDiplomado" type="text" class="form-control" required>
                                <div class="invalid-feedback">
                                    Ingrese un nombre de diplomado!
                                </div>
                            </div>
                        </div>
                                    
                        <div class="col-md-12">
                            <label for="validationCustomCorreo" class="form-label">Codigo del diplomado</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-file-lines"></i></span>
                                <input name="codigoDiplomado" type="text" class="form-control" id="validaCorreo" required>
                                <div class="invalid-feedback">
                                    Codigo no valido!
                                </div>
                            </div>
                        </div>
            
                        <div class="col-md-12">
                            <label for="validationCustomCorreo" class="form-label">Departamento</label>
                            <input name="deptoDiplomado" class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Buscar Departmento..." required>
                            <datalist id="datalistOptions">
                                <option value="EPOS" label="Posgrado"></option>
                            </datalist>
                        </div>
            
                        <div class="col-md-12">
                            <label for="validationCustomCorreo" class="form-label">Cargar pdf informativo</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text" id="inputGroupPrepend"><i class="fa-regular fa-file"></i></span>
                                <input name="archivoDiplomado" accept=".pdf" type="file" class="form-control" aria-describedby="inputGroupPrepend" required>
                                <div class="invalid-feedback">
                                    Seleccione un archivo
                                </div>
                            </div>
                        </div>
            
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Registrar Diplomado</button>
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
        $('.formEliminarDiplomado').on('submit', function(e){
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

    @if (Session::has('resDiplomado'))
        <script>
            Swal.fire({
                title: "Informacion",
                text: "{{ session('resDiplomado') }}",
                icon: "success"
            });
        </script>  
    @endif

    @if (Session::has('resDelDiplomado'))
        <script>
            Swal.fire({
                title: "Informacion",
                text: "{{ session('resDelDiplomado') }}",
                icon: "success"
            });
        </script>  
    @endif

    @if (Session::has('resEditDiplomado'))
        <script>
            Swal.fire({
                title: "Informacion",
                text: "{{ session('resEditDiplomado') }}",
                icon: "success"
            });
        </script>  
    @endif

    
@endsection