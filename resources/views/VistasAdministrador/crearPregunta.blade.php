@extends('Layouts.dashboard')
@section('titulo', '- Ingresar Pregunta')

@section('contenido')

    <div class="container">

        <h2>Ingresar una pregunta frecuente</h2>

        <form class="formIngresarPregunta" action="{{ route('guardarPregunta')}}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Pregunta</label>
                <input name="tituloPregunta" type="text" class="form-control" id="preguntaFrecuente" placeholder="¿Que es traslado?">
            </div>

            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Respuesta</label>
                <textarea name="respuestaPreguntaFrecuente" id="respuestaFrecuente" cols="30" rows="50"></textarea>

                <script>
                    ClassicEditor
                        .create( document.querySelector( '#respuestaFrecuente' ) )
                        .catch( error => {
                            console.error( error );
                        } );
                </script>
                
            </div>

            <div class="mb-3">
                <a href="{{ route('regrersarPregunta') }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>

        </form>

    </div>


@endsection

@section('jsVistasAdmin')

    <script>
        //Validacion de que los campos no estén vacios
        $('.formIngresarPregunta').on('submit', function(e) {

            var pregunta = $('#preguntaFrecuente').val().trim();
            var respuesta = $('#respuestaFrecuente').val().trim();


            if (pregunta === "" || respuesta === "") {
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