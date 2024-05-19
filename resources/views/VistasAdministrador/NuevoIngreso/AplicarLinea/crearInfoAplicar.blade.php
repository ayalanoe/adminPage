@extends('Layouts.dashboard')
@section('titulo', '- Agregar Información')

@section('contenido')

    <div class="container">

        <h2>Detalles de Aplicar en Linea</h2>
        <hr>

        <form class="formAplicarLinea" action="{{ route('aplicarEnLineaGuardar') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Clasificación</label>
                <input name="tipoConsultaAplyLinea" value="Apl_linea" type="text" class="form-control" readonly>
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Titulo:</label>
                <input name="titAplicar" type="text" class="form-control" id="ApplyLine" placeholder="Escriba: Aplicar en Línea">
            </div>

            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Detalles informativos:</label>
                <textarea name="detalleAplicar" id="editor" cols="30" rows="50"></textarea>

                <script>
                    ClassicEditor
                        .create( document.querySelector( '#editor' ) )
                        .catch( error => {
                            console.error( error );
                        } );
                </script>
                
            </div>

            <div class="mb-3">
                <a href="{{ route('aplicarLinea') }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>

        </form>

    </div>

@endsection

@section('jsVistasAdmin')
    <script>
        $('.formAplicarLinea').on('submit', function(e) {

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