@extends('Layouts.dashboard')

@section('titulo', '- Galería Institucional')

@section('contenido')

    <div class="container">

        <h2 class="global-tittle">GALERÍA INSTITUCIONAL - {{date('Y')}}</h2>
        <hr>
        <br>
        <div class="container">
            <button type="button" class="btn btn-success mx-1" data-bs-toggle="modal" data-bs-target="#ModalCrearGaleria"><i class="fa-solid fa-plus"></i> Agregar Foto</button>
        </div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Fecha de Publición</th>
                    <th scope="col">Nombre Foto</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
    
            <tbody>
    
                @php
                    $numero = 1 
                @endphp
    
                @foreach ($galeriaFotos as $fotoGaleria)
    
                    <tr>
                        <th scope="row">{{$numero}}</th>  
                        <td>{{$fotoGaleria->fechaPublicacion}}</td>
                        <td>{{$fotoGaleria->nombreFoto}}</td>
                        <td class="d-flex">
    
                            @if ($fotoGaleria->rutaArchivo)
                                <form action="{{ route('eliminarFotoGaleria', $fotoGaleria->id)}}" class="formEleminarFotoGaleria" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger mx-1"><i class="fa-solid fa-trash"></i></button>
                                </form>
                                    
                                <a href="{{route('verFotoGaleriaAdmin', $fotoGaleria->id)}}" class="btn btn-secondary mx-1" target="_blank"><i class="fa-solid fa-eye"></i></a>
                            @endif
                            
                        </td>
                    </tr>
    
                    @php
                        $numero++
                    @endphp
                    
                @endforeach
    
            </tbody>
        </table>

    </div>


    <!-- Modal Para ingresar un foto para la galeria-->
    <div class="modal fade" id="ModalCrearGaleria" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Foto para galeria institucional</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

            <form action="{{ route('guardarGaleria') }}" method="POST" class="row g-3 needs-validation" enctype="multipart/form-data" novalidate>
                @csrf

                <div class="col-md-12">
                    <label for="validationCustomUser" class="form-label">Nombre de la foto o imagen</label>
                    <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-t"></i></span>
                        <input name="nombreGaleria" type="text" class="form-control" id="nombreCalendarioAcademico" required>
                        <div class="invalid-feedback">
                            Campo vacío!
                        </div>
                    </div>
                </div>
                
                <div class="col-md-12">
                    <label for="validationCustomCorreo" class="form-label">Cargar Foto</label>
                    <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend"><i class="fa-regular fa-file"></i></span>
                        <input name="fotoGaleria" accept=".jpg, .jpeg, .png" type="file" class="form-control" aria-describedby="inputGroupPrepend" required>
                        <div class="invalid-feedback">
                            Seleccione un archivo
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Publicar Foto</button>
                </div>

            </form>

            </div>       
        </div>
        </div>
    </div>
    
@endsection

@section('jsVistasAdmin')

    <script>
        $('.formEleminarFotoGaleria').on('submit', function(e){
            e.preventDefault();

            Swal.fire({
                title: "¿Está seguro?",
                text: "Se eliminará la foto de la galeria",
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

    @if (Session::has('resCrarGaleria'))
    <script>
        Swal.fire({
            title: "Informacion",
            text: "{{ session('resCrarGaleria') }}",
            icon: "success"
        });
    </script>  
    @endif

    @if (Session::has('resEliminarFotoGaleria'))
    <script>
        Swal.fire({
            title: "Informacion",
            text: "{{ session('resEliminarFotoGaleria') }}",
            icon: "success"
        });
    </script>  
    @endif

@endsection