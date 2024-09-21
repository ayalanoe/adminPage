@extends('Layouts.dashboard')
@section('titulo', '- Editar Requisitos y Fecha')

@section('contenido')

<div class="container">

    <h2 class="global-tittle">EDITAR REQUISITOS Y FECHAS</h2>
    <hr>

    <form action="{{ route('guardarNewDatosReqFecha', $editarReqFecha->id) }}" class="editFormReqFechas" method="POST">
        @csrf

        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Titulo</label>
            <input name="editTituloReqFecha" value="{{$editarReqFecha->titulo}}" type="text" class="form-control" id="ReqFechas">
        </div>


        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Requisitos y Fechas:</label>
            <textarea name="editContentReqFecha" id="editor" cols="30" rows="50">{{$editarReqFecha->contenido}}</textarea>

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
        $('.editFormReqFechas').on('submit', function(e) {

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

