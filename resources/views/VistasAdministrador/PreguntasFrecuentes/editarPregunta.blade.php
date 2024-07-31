@extends('Layouts.dashboard')
@section('titulo', '- Editar Pregunta')

@section('contenido')

    <div class="container">

        <h2>Editar pregunta frecuente</h2>
        <hr>

        <form class="formEditarPregunta" action="{{ route('guardarNewDatosPregunta', $datosEditarPregunta->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Pregunta</label>
                <input id="preguntaEdit" name="editarPregunta" type="text" class="form-control" value="{{$datosEditarPregunta->pregunta}}">
            </div>

            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Respuesta</label>
                <textarea name="editarRespuestaPregunta" id="respuestaEdit" cols="30" rows="50"> {{$datosEditarPregunta->respuesta}} </textarea>

                <script>
                    ClassicEditor
                        .create( document.querySelector( '#respuestaEdit' ) )
                        .catch( error => {
                            console.error( error );
                        } );
                </script>
                
            </div>

            <div class="mb-3">
                <a href="{{ route('regrersarPregunta')}}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            </div>

        </form>

    </div>


@endsection

@section('jsVistasAdmin')

    <script>
        //Validacion de que los campos no estén vacios
        $('.formEditarPregunta').on('submit', function(e) {

            var editPregunta = $('#preguntaEdit').val().trim();
            var editRespuesta = $('#respuestaEdit').val().trim();


            if (editPregunta === "" || editRespuesta === "") {
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