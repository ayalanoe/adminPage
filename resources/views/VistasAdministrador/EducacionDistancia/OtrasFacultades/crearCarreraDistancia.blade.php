@extends('Layouts.dashboard')
@section('titulo', '- Crear Carreras a Distancia')

@section('contenido')

    <div class="container">

        <h2>Agregar Información de Nueva Carrera a Distancia</h2>

        <form class="formCrearTramite" action="{{ route('crearTramite') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Nombre de la carrera</label>
                <input name="tituloTramite" type="text" class="form-control" id="tituloTramite" placeholder="Licenciatura en ...">
            </div>
   
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Banner de la carrera</label>
                <input name="archivoTramite" accept=".pdf, .jpg, .jpeg, .png, .doc, .docx" type="file" class="form-control" aria-describedby="inputGroupPrepend">
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">PDF informativo de la carrera</label>
                <input name="archivoTramite" accept=".pdf, .doc, .docx" type="file" class="form-control" aria-describedby="inputGroupPrepend">
                
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