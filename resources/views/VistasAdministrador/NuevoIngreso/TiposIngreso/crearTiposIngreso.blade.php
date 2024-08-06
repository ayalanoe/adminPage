@extends('Layouts.dashboard')
@section('titulo', '- Crear Tipo de Ingreso')

@section('contenido')

    <div class="container">

        <h2 class="global-tittle">CREAR TIPO DE INGRESO</h2>
        <hr>

        <form class="formCrearTipo" action="{{ route('guardarTipoIngreso') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Clasificación</label>
                <input name="tipoConsultaTipoIngreso" value="Tipo_ingreso" type="text" class="form-control" readonly>
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Título del Ingreso</label>
                <input name="tituloTipoIngreso" type="text" class="form-control" id="tipoIngreso" placeholder="Ingreso General Universitario" required>
            </div>


            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Descripción del tipo de ingreso:</label>
                <div class="form-floating">
                    <textarea name="descripIngreso" class="form-control" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                    <label for="floatingTextarea">Descripcion 254 caracteres máximo</label>
                </div>
            </div>
            

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Imagen del ingreso</label>
                <input name="archivoTipoIngreso" accept=".jpg, .jpeg, .png" type="file" class="form-control" aria-describedby="inputGroupPrepend" required>
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