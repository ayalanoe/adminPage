@extends('Layouts.dashboard')
@section('titulo', '- Crear Tramite')

@section('contenido')

    <div class="container">

        <h2>Crear tramite académico</h2>

        <form action="{{ route('crearTramite') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Titulo del tramite</label>
                <input name="tituloTramite" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Cambios de horario">
            </div>
   
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Formato del tramite o archivo</label>
                <input name="archivoTramite" accept=".pdf, .jpg, .jpeg, .png" type="file" class="form-control" aria-describedby="inputGroupPrepend">
            </div>

            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
                <textarea name="contenidoTramite" id="editor" cols="30" rows="50"></textarea>

                <script>
                    ClassicEditor
                        .create( document.querySelector( '#editor' ) )
                        .catch( error => {
                            console.error( error );
                        } );
                </script>
                
            </div>

            <div class="mb-3">
                <a href="{{ route('verTramitesAcademicos') }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>

        </form>

    </div>

    


@endsection