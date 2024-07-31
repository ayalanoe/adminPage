@extends('Layouts.dashboard')

@section('titulo', '- Catálogo Académico')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/cssAdministrador/calendarioAdministrativo.css')}}">   
@endsection

@section('contenido')
    
    <br><br>

    <h2>Catálogo Académico Año - {{date('Y')}}</h2>
    <br>

    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Titulo</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>

        <tbody>
            @php
                $numero = 1 
            @endphp

            @forelse ($catalogoDisponible as $catalogoAcademico)
                <tr>
                    <th scope="row">{{$numero}}</th>  
                    <td>{{$catalogoAcademico->titulo}}</td>
                    <td>{{$catalogoAcademico->descripcion}}</td>
                    <td class="d-flex">

                        @if ($catalogoAcademico->rutaArchivo)
                            <form class="fluid formEliminarCatalogo" action="{{ route('elimnarCatalogoAca', $catalogoAcademico->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger mx-1"><i class="fa-solid fa-trash"></i></button>
                            </form>
                            <a href="{{route('verPdfCatalogo', $catalogoAcademico->id)}}" class="btn btn-secondary mx-1" target="_blank"><i class="fa-solid fa-eye"></i></a>
                        @endif
                        
                    </td>
                </tr>
                @php
                    $numero++
                @endphp

                @empty
                <tr>
                    <th>1</th>
                    <td>Subir catálogo académico</td>
                    <td>-</td>
                    <td colspan="3">
                        <a class="btn btn-secondary" href="catalogoAcademico" data-bs-toggle="modal" data-bs-target="#subirCatalogo"><i class="fa-sharp fa-solid fa-upload"></i></a>
                    </td>
                </tr>

            @endforelse
        </tbody>
    </table>


    @if (Session::has('resSubirCatalogo'))
        <script>
            Swal.fire({
                title: "Informacion",
                text: "{{ session('resSubirCatalogo') }}",
                icon: "success"
            });
        </script>
    @endif


    @if (Session::has('resEliminarCatalogo'))
        <script>
            Swal.fire({
                title: "Informacion",
                text: "{{ session('resEliminarCatalogo') }}",
                icon: "success"
            });
        </script>
    @endif

@endsection

@section('jsVistasAdmin')

    <script>

        $('.formEliminarCatalogo').on('submit', function(e){
            
            e.preventDefault();
            Swal.fire({
                title: "¿Está seguro?",
                text: "Se eliminará el catálogo académico",
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

    <!-- Modal para subir el calendario administrativo ciclo-1 -->
    <div class="modal fade" id="subirCatalogo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Subir catálogo de la FMO</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    

                    <form action="{{ route('subirCatalogoNuevoIngreso') }}" method="POST" enctype="multipart/form-data" class="row g-3 needs-validation" novalidate>
                        @csrf

                        <div class="col-md-12">
                            <label for="validationCustomUser" class="form-label">Clasificación:</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-t"></i></span>
                                <input name="tipoConsultaCatalogo" value="Catalogo" type="text" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label for="validationCustomUser" class="form-label">Titulo:</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-t"></i></span>
                                <input name="tituloCatalogo" type="text" class="form-control" required>
                                <div class="invalid-feedback">
                                    Ingrese un nombre. Máximo de caracteres 254 !
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label for="validationCustomUser" class="form-label">Pequeña descripción:</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-t"></i></span>
                                <textarea name="descripcionCatalogo" type="text" class="form-control" required></textarea>
                                <div class="invalid-feedback">
                                    Ingrese una descripcion !
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <label for="validationCustomCorreo" class="form-label">Cargar archivo</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text" id="inputGroupPrepend"><i class="fa-regular fa-file"></i></span>
                                <input name="archivoCatalogo" accept=".pdf" type="file" class="form-control" aria-describedby="inputGroupPrepend" required>
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

