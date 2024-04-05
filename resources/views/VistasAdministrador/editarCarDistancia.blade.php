@extends('Layouts.dashboard')
@section('titulo', '- Editar Carrera Distancia')

@section('contenido')

    <div class="container">
        <h2>Editar carrera a distancia</h2>

        <br>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">PDF Informativo</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @php
                $numero = 1 
                @endphp

                <th scope="row">{{$numero}}</th>  
                @if ($carreraDisEdiar->rutaArchivo)
                    <td>Archivo_Cargado</td>
                    <td class="d-flex">
                        <form class="formElimarPdfCarDis" action="{{ route('elimarPdfCarDistancia', $carreraDisEdiar->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger mx-1"><i class="fa-solid fa-trash"></i></button>
                        </form> 
                        <a href="#" class="btn btn-primary mx-1" target="_blank"><i class="fa-solid fa-eye"></i></a>
                    </td>
                @else
                    <td>Favor subir archivo pdf</td>
                    <td class="d-flex">  
                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#nuevoPlanCarDistancia"><i class="fa-sharp fa-solid fa-upload"></i></button>
                    </td>
                @endif
            
            </tbody>
        </table>

        <form action="{{ route('nuevoNombreCarDis', $carreraDisEdiar->id)}}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Nombre Carrera</label>
                <input name="nombreCarDistancia" type="text" class="form-control" value="{{$carreraDisEdiar->carrera}}">
            </div>

            <div class="mb-3">
                <a href="{{ route('carrerasDistancia') }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            </div>
        </form>


        <!------------- Modal para subir el archivo pdf nuevamente el pdf del plan de estudio de la carrera a distancia -->
        <div class="modal fade" id="nuevoPlanCarDistancia" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
        
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Subir pdf de la carrera a distancia</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <form action="{{ route('nuevoPdfCarDis', $carreraDisEdiar->id)}}" enctype="multipart/form-data" method="POST" class="row g-3 needs-validation" novalidate>
                            @csrf

                            <div class="col-md-12">
                                <label for="validationCustomCorreo" class="form-label">Cargar archivo del plan de estudio</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i class="fa-regular fa-file"></i></span>
                                    <input name="editNuevoPlanCarDis" accept=".pdf" type="file" class="form-control" aria-describedby="inputGroupPrepend" required>
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


    </div>
    
@endsection

@section('jsVistasAdmin')


    <script>

        $('.formElimarPdfCarDis').on('submit', function(e){
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

    @if (Session::has('resEliminarPdfCarDis'))
    <script>
        Swal.fire({
            title: "Información",
            text: "{{ session('resEliminarPdfCarDis') }}",
            icon: "success"
        });
    </script>  
    @endif
    
    @if (Session::has('resNewPdfCarDis'))
    <script>
        Swal.fire({
            title: "Información",
            text: "{{ session('resNewPdfCarDis') }}",
            icon: "success"
        });
    </script>  
    @endif

    @if (Session::has('resNewNameCarDis'))
    <script>
        Swal.fire({
            title: "Información",
            text: "{{ session('resNewNameCarDis') }}",
            icon: "success"
        });
    </script>  
    @endif

    @if (Session::has('errorNewNameCarDis'))
    <script>
        Swal.fire({
            title: "Información",
            text: "{{ session('errorNewNameCarDis') }}",
            icon: "error"
        });
    </script>  
    @endif

@endsection