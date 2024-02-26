@extends('Layouts.dashboard')
@section('titulo', '- Crear anuncio')

@section('contenido')

    <div class="container">

        <h2>Crear anuncio académico</h2>

        <form action="{{ route('crearAnuncio') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Titulo del anuncio</label>
                <input name="tituloAnuncio" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Cambios de horario">
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Fecha de expiración</label>
                <input name="fechaExpiracionAnuncio" type="date" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" style="width: 200px;">
            </div>        

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Cargar foto</label>
                <input name="archivoAnuncio" accept=".pdf, .jpg, .jpeg, .png" type="file" class="form-control" aria-describedby="inputGroupPrepend">
            </div>

            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
                <textarea name="cuerpoAnuncio" id="editor" cols="30" rows="50"></textarea>

                <script>
                    ClassicEditor
                        .create( document.querySelector( '#editor' ) )
                        .catch( error => {
                            console.error( error );
                        } );
                </script>
                
            </div>

            <div class="mb-3">
                <a href="{{ route('cancelarCrearAnuncio') }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>

        </form>

    </div>

    


@endsection