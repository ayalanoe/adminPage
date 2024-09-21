@extends('Layouts.dashboard')
@section('titulo', '- Editar Aplicar en Linea')

@section('contenido')

    <div class="container">

        <h2 class="global-tittle">EDITAR INFORMACIÓN PARA APLICAR EN LÍNEA</h2>
        <hr>
        
        <form action="{{ route('guardarNewDatosAplicar', $editApliEnLinea->id)}}" class="formEditAplicarEnLinea" method="POST">
            @csrf

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Titulo:</label>
                <input name="editTitAplicar" value="{{$editApliEnLinea->titulo}}" type="text" class="form-control" id="editTituloAplicar" placeholder="Escriba: Aplicar en Línea">
            </div>

            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Detalles informativos:</label>
                <textarea name="editDetalleAplicar" id="editor" cols="30" rows="50">{{$editApliEnLinea->contenido}}</textarea>

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
        $('.formEditAplicarEnLinea').on('submit', function(e) {

            var tramiteTitulo = $('#editTituloAplicar').val().trim();
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