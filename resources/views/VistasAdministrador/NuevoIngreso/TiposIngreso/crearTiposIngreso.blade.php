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
                    <textarea name="descripIngreso" class="form-control h-auto" placeholder="Leave a comment here" id="floatingTextarea" maxlength="255"></textarea>
                    <label for="floatingTextarea">Descripcion 254 caracteres máximo</label>
                </div>
                <div id="charCount" class="text-muted">254 caracteres restantes</div>
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
        const textarea = document.getElementById('floatingTextarea');
        const charCount = document.getElementById('charCount');
        const maxChars = 254;

        textarea.addEventListener('input', () => {
            const remaining = maxChars - textarea.value.length;
            charCount.textContent = `${remaining} caracteres restantes`;

            if (remaining < 0) {
                charCount.style.color = 'red';
            } else {
                charCount.style.color = 'gray';
            }
        });

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