@extends('Layouts.dashboard')
@section('titulo', '- Crear Tipo de Ingreso')

@section('contenido')

    <div class="container">

        <h2>Crear tipo de ingreso</h2>

        <form class="formCrearTipo" action="{{ route('crearIngreso') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Titulo del Ingreso</label>
                <input name="tituloTipoIngreso" type="text" class="form-control" id="tipoIngreso" placeholder="Ingreso General Universitario">
            </div>
   
            

            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Descripción del tipo de ingreso:</label>
                <textarea name="descripIngreso" id="editor" cols="30" rows="50"></textarea>

                <script>
                    ClassicEditor
                        .create( document.querySelector( '#editor' ) )
                        .catch( error => {
                            console.error( error );
                        } );
                </script>
                
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Imagen del ingreso</label>
                <input name="archivoIngreso" accept=".jpg, .jpeg, .png" type="file" class="form-control" aria-describedby="inputGroupPrepend">
            </div>

            <div class="mb-3">
                <a href="{{ route('vertiposingreso') }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>

        </form>

    </div>

@endsection

@section('jsVistasAdmin')
    <script>
        $('.formCrearTipo').on('submit', function(e) {

            var tramiteTitulo = $('#tituloTramite').val().trim();
            var tramiteContenido = $('#editor').val().trim();

            if (tramiteTitulo === "" || tramiteContenido === "") {
                e.preventDefault(); // evita el envío del formulario si hay campos vacíos

                Swal.fire({
                    title: "Campos vacíos",
                    text: "Rellene todos los campos",
                    icon: "error"
                });
            }
        });
    </script>
@endsection