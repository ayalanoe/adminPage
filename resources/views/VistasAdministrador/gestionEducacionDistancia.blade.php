@extends('Layouts.dashboard')
@section('titulo', '- Carreras a Distancia')

@section('contenido')

    <div class="container">
        <h2>Gestion de Carreras a Distancia</h2>

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
        
                        <form class="formEliminarCarDistancia" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger mx-1"><i class="fa-solid fa-trash"></i></button>
                        </form> 
                        
                        <a href="#" class="btn btn-primary mx-1">
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
        <button type="submit" class="btn btn-success mx-1" data-bs-toggle="modal" data-bs-target="#modalCarreraDistancia"><i class="fa-solid fa-plus"></i> Agregar Carrea A Distancia</button>
    </div>
    

    <div class="modal fade" id="modalCarreraDistancia" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
    
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Registro de carrera de pregrado</h1>
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
                            <label for="validationCustomCorreo" class="form-label">Banner de la carrera</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text" id="inputGroupPrepend"><i class="fa-regular fa-file"></i></span>
                                <input name="bannerCarDistancia" accept=".jpg, .png, .jpeg" type="file" class="form-control" aria-describedby="inputGroupPrepend" required>
                                <div class="invalid-feedback">
                                    Seleccione un archivo
                                </div>
                            </div>
                        </div>

            
                        <div class="col-md-12">
                            <label for="validationCustomCorreo" class="form-label">Cargar archivo del plan de estudio pdf</label>
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

    @if (Session::has('resGuardarCarDistancia'))
        <script>
            Swal.fire({
                title: "Informacion",
                text: "{{ session('resGuardarCarDistancia') }}",
                icon: "success"
            });
        </script>  
    @endif

    
    
@endsection