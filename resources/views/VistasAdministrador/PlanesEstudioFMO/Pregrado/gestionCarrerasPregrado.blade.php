@extends('Layouts.dashboard')
@section('titulo', '- Planes de Estudio')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/cssAdministrador/textoGestionGlobal.css') }}">   
@endsection
@section('contenido')

    <div class="container">
        @php
            $nombresDeptos = [
                "INGA" => "Ingeniería y Arquitectura",
                "MED" => "Medicina",
                "CCHH" => "Ciencias y Humanidades",
                "JCCSS" => "Jurisprudencia y Ciencias Sociales",
                "CCEE" => "Ciencias Económicas",
                "CCNN" => "Ciencias Naturales y Matemáticas",
                "CCAA" => "Ciencias Agronómicas",
                "QQFF" => "Química y Farmacia",
                "EPOS" => "Posgrado",
                "ECTM" => "Carreras Técnicas",
                "PLCOM" => "Planes Complementarios"
            ];

            $nombreDepto = $nombresDeptos[$departamento] ?? "No encontrado";
        @endphp

        <h2 class="global-tittle">DEPARTAMENTO: {{ mb_strtoupper($nombreDepto) }}</h2>
        <hr>
        <br>

        
        <!-- Bton para poder insertar una carrera de pregrado -->
        <div class="container">
            <a href="{{ route('regresarA_Departamentos') }}" class="btn btn-secondary mx-1"><i class="fa-solid fa-circle-arrow-left"></i> Volver a Departementos</a>
            <button type="submit" class="btn btn-success mx-1" data-bs-toggle="modal" data-bs-target="#ModalAgregarCarreraPregrado"><i class="fa-solid fa-plus"></i> Agregar Carrera Pre_Grado</button>
        </div>
        <br>
        <br>
        @if ($carrerasPregrado->isEmpty())
        <div class="alert alert-empty text-center">
            ¡No se han registrado carerras!
        </div>
        <br><br><br><br><br>
        @else

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
            
                    @foreach ($carrerasPregrado as $carrera)
                    <tr>
                        <th scope="row">{{$numero}}</th>  
                        <td>{{$carrera->carrera}}</td>
                        <td>{{$carrera->codigoCarrera}}</td>
                        <td>{{$carrera->tipoCarrera}}</td>
                        <td>{{$nombreDepto}}</td><!--Actualizar agregando campo tramites-->
                        <td class="d-flex">
            
                            <form class="formEliminarCarreraPergrado" action="{{ route('eliminarCarreraDePregrado', $carrera->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger mx-1"><i class="fa-solid fa-trash"></i></button>
                            </form> 
                            
                            <a href="{{ route('editarCarreraDePregrado', $carrera->id) }}" class="btn btn-primary mx-1">
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
        @endif
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
                                <div class="invalid-feedback">
                                    Ingrese una carrera!
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
                            <select name="departamentoCarreraPregrado" class="form-control" id="exampleDataList" required>
                                <option value="{{$departamento}}" selected>{{$departamento}} - {{$nombreDepto}}</option>
                            </select>
                        </div>
                        
                        <div class="col-md-12">
                            <label for="validationCustomCorreo" class="form-label">Cargar archivo del plan de estudio</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text" id="inputGroupPrepend"><i class="fa-regular fa-file"></i></span>
                                <input name="archivoPregradoCarrera" accept=".pdf" type="file" class="form-control" aria-describedby="inputGroupPrepend" required>
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
        $('.formEliminarCarreraPergrado').on('submit', function(e){
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

    @if (Session::has('resCarreraPregrado'))
        <script>
            Swal.fire({
                title: "Informacion",
                text: "{{ session('resCarreraPregrado') }}",
                icon: "success"
            });
        </script>  
    @endif

    @if (Session::has('resEliminarCarreraPregrado'))
    <script>
        Swal.fire({
            title: "Informacion",
            text: "{{ session('resEliminarCarreraPregrado') }}",
            icon: "success"
        });
    </script>  
    @endif

    @if (Session::has('resUpdateCarrPre'))
    <script>
        Swal.fire({
            title: "Informacion",
            text: "{{ session('resUpdateCarrPre') }}",
            icon: "success"
        });
    </script>  
    @endif


        
@endsection