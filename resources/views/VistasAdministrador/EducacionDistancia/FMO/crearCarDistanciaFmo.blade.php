@extends('Layouts.dashboard')
@section('titulo', '- Carrera Distancia FMO')

@section('contenido')
    
    <div class="container">

        <h2>Crear carrera a distancia de la FMO </h2>
        <hr>

        <form action="{{ route('guardarCarDisFMO') }}" class="formCrarCarDisFmo" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Facultad</label>
                <input value="FMO" name="facultadCarDisFMO" type="text" class="form-control" readonly>
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Nombre de la Carrera</label>
                <input name="nombreCarDisFMO" type="text" class="form-control" id="anuncioTitulo" placeholder="Logistica internacional" required>
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Cargar imagen para el banner</label>
                <input name="bannerCarDisFMO" accept=".jpg, .jpeg, .png" type="file" id="anuncioArchivo" class="form-control" aria-describedby="inputGroupPrepend" required>
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Cargar pdf informativo o plan de estudio</label>
                <input name="archivoCarDisFMO" accept=".pdf" type="file" id="anuncioArchivo" class="form-control" aria-describedby="inputGroupPrepend" required>
            </div>

            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Información para la carrera</label>
                <textarea name="contenidoCarDisFMO" id="editorCarDis" cols="30" rows="50"></textarea>

                <script>
                    ClassicEditor
                        .create( document.querySelector( '#editorCarDis' ) )
                        .catch( error => {
                            console.error( error );
                        } );
                </script>
                
            </div>

            <div class="mb-3">
                <a href="{{ route('carrerasDistanciaFmo') }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>

        </form>

    </div>

@endsection