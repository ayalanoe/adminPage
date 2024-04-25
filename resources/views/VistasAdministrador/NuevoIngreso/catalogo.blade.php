@extends('Layouts.dashboard')

@section('titulo', '- Catálogo Académico')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/cssAdministrador/calendarioAdministrativo.css')}}">   
@endsection

@section('contenido')
    
    <br><br>

    <h2>Catálogo Académico Año - {{date('Y')}}</h2>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre del archivo</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>

        <tbody>

                
               
                <tr>
                    <th>1</th>
                    <td>Subir catálogo académico</td>
                    <td colspan="3">
                        <a class="btn btn-secondary" href="catalogoAcademico" data-bs-toggle="modal" data-bs-target="#subirCatalogo"><i class="fa-sharp fa-solid fa-upload"></i></a>
                    </td>
                </tr>

            
        </tbody>
    </table>



    @if (Session::has('resSubirCalAdmin'))
        <script>
            Swal.fire({
                title: "Informacion",
                text: "{{ session('resSubirCalAdmin') }}",
                icon: "success"
            });
        </script>
    @endif


    @if (Session::has('resEliminarCalAdmin'))
        <script>
            Swal.fire({
                title: "Informacion",
                text: "{{ session('resEliminarCalAdmin') }}",
                icon: "success"
            });
        </script>
    @endif

@endsection

@section('jsVistasAdmin')

    <script>

        $('#formEliminarCalAdmin').on('submit', function(e){
            
            e.preventDefault();
            Swal.fire({
                title: "¿Está seguro?",
                text: "Se eliminará el calendario administrativo",
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
    <div class="modal fade" id="subirCalAdminCx" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Subir calendario académico ciclo-I</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    

                    <form action="{{route('subirCalAdmin')}}" method="POST" enctype="multipart/form-data" class="row g-3 needs-validation" novalidate>
                        @csrf

                        <div class="col-md-12">
                            <label for="validationCustomUser" class="form-label">Nombre Archivo</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-t"></i></span>
                                <input name="nombreArchivo" type="text" class="form-control" id="nombreCalendarioAcademico" required>
                                <div class="invalid-feedback">
                                    Escriba un nombre!
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <label for="validationCustomCorreo" class="form-label">Cargar archivo</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text" id="inputGroupPrepend"><i class="fa-regular fa-file"></i></span>
                                <input name="archivo" accept=".pdf" type="file" class="form-control" aria-describedby="inputGroupPrepend" required>
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

