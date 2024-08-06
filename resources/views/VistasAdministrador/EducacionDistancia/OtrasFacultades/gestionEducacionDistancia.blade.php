@extends('Layouts.dashboard')
@section('titulo', '- Carreras a Distancia')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/cssAdministrador/textoGestionGlobal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/cssAdministrador/tablas.css')}}">
    <link rel="stylesheet" href="{{ asset('css/cssAdministrador/alertVacio.css') }}">
@endsection

@section('contenido')

    <div class="container">
        <h2 class="global-tittle">CARRERAS A DISTANCIA DE OTRAS FACULTADES</h2>
        <hr>
    <div class="container">
        <button type="submit" class="btn btn-success mx-1" data-bs-toggle="modal" data-bs-target="#modalCarreraDistancia"><i class="fa-solid fa-plus"></i> Agregar Carrera</button>
    </div>
    @if ($educacionDistancia->isEmpty())
            <div class="alert alert-empty text-center">
                ¡NO SE HAN REGISTRADO CARRERAS!
            </div>
            <br><br><br><br><br>
        @else
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Carrera</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $numero = 1 
                @endphp
        
                @foreach ($educacionDistancia as $carreraDistancia)
                <tr>
                    <th scope="row">{{$numero}}</th>  
                    <td>{{$carreraDistancia->carrera}}</td>

                    <td class="d-flex">
        
                        <form action="{{ route('eliminarCarDistancia', $carreraDistancia->id)}}" class="formEliminarCarDistancia" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger mx-1"><i class="fa-solid fa-trash"></i></button>
                        </form> 
                        
                        <a href="{{ route('vistaEditarCarDistancia', $carreraDistancia->id) }}" class="btn btn-primary mx-1">
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
    
    <div class="modal fade" id="modalCarreraDistancia" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
    
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Registro de carrera a distancia</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
    
                    <form action="{{ route('guardarCarDistancia') }}" enctype="multipart/form-data" method="POST" class="row g-3 needs-validation" novalidate>
                        @csrf


                        <div class="col-md-12">
                            <label for="validationCustomUser" class="form-label">Nombre de la carrera</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-pen-to-square"></i></span>
                                <input name="nombreCarDistancia" type="text" class="form-control" id="validaUser" required>
                                <div class="invalid-feedback">
                                    Ingrese una carrera!
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label for="validationCustomCorreo" class="form-label">Banner de la carrera para adornar</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text" id="inputGroupPrepend"><i class="fa-regular fa-file"></i></span>
                                <input name="bannerCarDistancia" accept=".jpg, .png, .jpeg" type="file" class="form-control" aria-describedby="inputGroupPrepend" required>
                                <div class="invalid-feedback">
                                    Seleccione un archivo
                                </div>
                            </div>
                        </div>

            
                        <div class="col-md-12">
                            <label for="validationCustomCorreo" class="form-label">Cargar archivo informativo o plan de estudio .pdf</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text" id="inputGroupPrepend"><i class="fa-regular fa-file"></i></span>
                                <input name="planCarDistancia" accept=".pdf" type="file" class="form-control" aria-describedby="inputGroupPrepend" required>
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

    <script>
        $('.formEliminarCarDistancia').on('submit', function(e){
            e.preventDefault();

            Swal.fire({
                title: "¿Está seguro?",
                text: "Se eliminará la carrera a distancia",
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

    @if (Session::has('resGuardarCarDistancia'))
        <script>
            Swal.fire({
                title: "Informacion",
                text: "{{ session('resGuardarCarDistancia') }}",
                icon: "success"
            });
        </script>  
    @endif

    @if (Session::has('carDisNoEncontrada'))
        <script>
            Swal.fire({
                title: "Informacion",
                text: "{{ session('carDisNoEncontrada') }}",
                icon: "success"
            });
        </script>  
    @endif

    @if (Session::has('resEliminarCarDistancia'))
        <script>
            Swal.fire({
                title: "Informacion",
                text: "{{ session('resEliminarCarDistancia') }}",
                icon: "success"
            });
        </script>  
    @endif

    
    
@endsection