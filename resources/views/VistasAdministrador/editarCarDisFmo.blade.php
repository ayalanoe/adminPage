@extends('Layouts.dashboard')
@section('titulo', '- Editar Carrera Distancia')

@section('contenido')
    
    <div class="container">

        <h2>Editar carrera a distancia de la fmo</h2>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">PDF Informativo</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @php
                $numero = 1 
                @endphp

                <th scope="row">{{$numero}}</th>  
                @if ($carreraDisFmoEdit->rutaArchivo)
                    <td>Archivo_Cargado</td>
                    <td class="d-flex">
                        <a href="{{ route('verPDFCarreraDisFmo', $carreraDisFmoEdit->id) }}" class="btn btn-primary mx-1" target="_blank"><i class="fa-solid fa-eye"></i></a>
                    </td>
                @endif
            
            </tbody>
        </table>

        <form action="{{ route('guardarNewDatosCarDisFmo', $carreraDisFmoEdit->id)}}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Nombre de la carrera</label>
                <input name="editCarDisFMO" type="text" class="form-control" value="{{$carreraDisFmoEdit->carrera}}">
            </div>

            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Información de la carrera</label>
                <textarea name="editContenidoCarDisFMO" id="editorCarDis" cols="30" rows="50">{{$carreraDisFmoEdit->contenido}}</textarea>

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
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            </div>
        </form>
    </div>


@endsection