@extends('Layouts.dashboard')
@section('titulo', '- Editar Pregunta')

@section('contenido')

    <div class="container">

        <h2>Editar pregunta frecuente</h2>

        <form action="{{ route('guardarNewDatosPregunta', $datosEditarPregunta->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Pregunta</label>
                <input name="editarPregunta" type="text" class="form-control" value="{{$datosEditarPregunta->pregunta}}">
            </div>

            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Respuesta</label>
                <textarea name="editarRespuestaPregunta" id="editor" cols="30" rows="50"> {{$datosEditarPregunta->respuesta}} </textarea>

                <script>
                    ClassicEditor
                        .create( document.querySelector( '#editor' ) )
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