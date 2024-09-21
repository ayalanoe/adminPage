@extends('Layouts.dashboard')
@section('titulo', '- Crear Tramite')

@section('contenido')

    <div class="container">

        <h2 class="global-tittle">REGISTRO DE TRÁMITE ACADÉMICO</h2>
        <hr>

        <form class="formCrearTramite" action="{{ route('crearTramite') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Titulo del tramite</label>
                <input name="tituloTramite" type="text" class="form-control" id="tituloTramite" placeholder="Cambios de horario">
            </div>
   
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Formato del tramite o archivo *OPCIONAL</label>
                <input name="archivoTramite" accept=".pdf, .jpg, .jpeg, .png, .doc, .docx" type="file" class="form-control" aria-describedby="inputGroupPrepend">
            </div>

            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Contenido del tramite</label>
                <textarea name="contenidoTramite" id="editor" cols="30" rows="50"></textarea>

                <script>
                    ClassicEditor
                        .create( document.querySelector( '#editor' ) )
                        .catch( error => {
                            console.error( error );
                        } );
                </script>
                
            </div>

            <div class="mb-3">
                <a href="{{ route('verTramitesAcademicos') }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>

        </form>

    </div>

@endsection

@section('jsVistasAdmin')
    <script>
        $('.formCrearTramite').on('submit', function(e) {

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