@extends('Layouts.dashboard')
@section('titulo', '- Ingresar Pregunta')

@section('contenido')

    <div class="container">

        <h2>Ingresar una pregunta frecuente</h2>

        <form action="{{ route('guardarPregunta')}}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Pregunta</label>
                <input name="tituloPregunta" type="text" class="form-control" id="exampleFormControlInput1" placeholder="¿Que es traslado?">
            </div>

            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Respuesta</label>
                <textarea name="respuestaPreguntaFrecuente" id="editor" cols="30" rows="50"></textarea>

                <script>
                    ClassicEditor
                        .create( document.querySelector( '#editor' ) )
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