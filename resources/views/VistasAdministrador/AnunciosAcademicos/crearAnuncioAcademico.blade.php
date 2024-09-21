@extends('Layouts.dashboard')
@section('titulo', '- Crear anuncio')

@section('contenido')

    <div class="container">

        <h2 class="global-tittle">CREAR ANUNCIO ACADÉMICO</h2>
        <hr>

        <form class="formCrearAnuncio" action="{{ route('crearAnuncio') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Título del anuncio</label>
                <input name="tituloAnuncio" type="text" class="form-control" id="anuncioTitulo" placeholder="Cambios de horario">
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Fecha de expiración</label>
                <input name="fechaExpiracionAnuncio" type="date" class="form-control" id="anuncioFechaExpiracion" style="width: 200px;">
            </div>        

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Cargar imagen informativa. *Opcional</label>
                <input name="archivoAnuncio" accept=".jpg, .jpeg, .png" type="file" id="anuncioArchivo" class="form-control" aria-describedby="inputGroupPrepend">
            </div>

            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Contenido del anuncio</label>
                <textarea name="cuerpoAnuncio" id="editorAnuncio" cols="30" rows="50"></textarea>

                <script>
                    ClassicEditor
                        .create( document.querySelector( '#editorAnuncio' ) )
                        .catch( error => {
                            console.error( error );
                        } );
                </script>
                
            </div>

            <div class="mb-3">
                <a href="{{ route('cancelarCrearAnuncio') }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar Anuncio</button>
            </div>

        </form>

    </div>

    


@endsection

@section('jsVistasAdmin')

    <script>
        //Validacion de que los campos no estén vacios
        $('.formCrearAnuncio').on('submit', function(e) {

            var tituloAnuncio = $('#anuncioTitulo').val().trim();
            var fechaExpAnuncio = $('#anuncioFechaExpiracion').val();
            var contenidoAnuncio = $('#editorAnuncio').val().trim();


            if (tituloAnuncio === "" || !fechaExpAnuncio || contenidoAnuncio === "") {
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