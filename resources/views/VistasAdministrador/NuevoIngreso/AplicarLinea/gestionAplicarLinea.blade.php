@extends('Layouts.dashboard')
@section('titulo', '- Aplicar en Linea')

@section('contenido')

    <div class="container">
        <h2>Información para Aplicar en Linea</h2>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Detalles</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                    <tr>
                        <th scope="row"></th>  
                        <td> </td>

                        <td class="d-flex">
            
                            <form action="" class="formDelLinea" method="POST">
                               
                                <button type="submit" class="btn btn-danger mx-1"><i class="fa-solid fa-trash"></i></button>
                            </form> 
                            
                            <a href=" " class="btn btn-primary mx-1">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            
                        </td>

                    </tr>
                
            </tbody>
        </table>
    </div>

    
    <div class="container">
        <a href="{{ route('infoAplicarLinea') }}" class="btn btn-success mx-1"><i class="fa-solid fa-plus"></i> Registrar información</a>
    </div>
    
@endsection

@section('jsVistasAdmin')

    <script>
        $('.formEliminarTramite').on('submit', function(e){
            e.preventDefault();

            Swal.fire({
                title: "¿Está seguro?",
                text: "Se eliminará el tramite",
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

    @if (Session::has('resCrearTramite'))
        <script>
            Swal.fire({
                title: "Informacion",
                text: "{{ session('resCrearTramite') }}",
                icon: "success"
            });
        </script>  
    @endif

    @if (Session::has('resEliminarTramite'))
        <script>
            Swal.fire({
                title: "Informacion",
                text: "{{ session('resEliminarTramite') }}",
                icon: "success"
            });
        </script>  
    @endif

    @if (Session::has('resEditarTramite'))
        <script>
            Swal.fire({
                title: "Informacion",
                text: "{{ session('resEditarTramite') }}",
                icon: "success"
            });
        </script>  
    @endif
    
@endsection