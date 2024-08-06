@extends('Layouts.dashboard')
@section('titulo', '- Agregar Información')

@section('contenido')

    <div class="container">

        <h2 class="global-tittle">DETALLES DE REQUISITOS Y FECHAS</h2>
        <hr>

        <form class="formReqFechas" action="{{ route('guardarReqFechaIngreso') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Clasificación</label>
                <input name="tipoReqFechIngreso" type="text" class="form-control" value="Req_fecha" readonly>
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Titulo</label>
                <input name="titReqFechas" type="text" class="form-control" id="ReqFechas" value="REQUISITOS Y FECHAS PARA APLICAR" readonly>
            </div>


            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Requisitos y Fechas:</label>
                <textarea name="detallesReqFechas" id="editor" cols="30" rows="50"></textarea>

                <script>
                    ClassicEditor
                        .create( document.querySelector( '#editor' ) )
                        .catch( error => {
                            console.error( error );
                        } );
                </script>
                
            </div>

            <div class="mb-3">
                <a href="{{ route('ReqFe') }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>

        </form>

    </div>

@endsection

@section('jsVistasAdmin')
    <script>
        $('.formReqFechas').on('submit', function(e) {

            var tramiteTitulo = $('#ReqFechas').val().trim();
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