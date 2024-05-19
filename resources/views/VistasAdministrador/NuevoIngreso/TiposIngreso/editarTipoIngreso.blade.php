@extends('Layouts.dashboard')
@section('titulo', '- Editar Tipo Ingreso')

@section('contenido')

    <div class="container">

        <h2>Editar tipo de ingreso</h2>

        <form action="{{route('nuevosDatosTipoIngreso', $tipoDeIngresoEditar->id)}}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Título del Ingreso</label>
                <input name="editTituloTipoIngreso" value="{{$tipoDeIngresoEditar->titulo}}" type="text" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Descripción del tipo de ingreso:</label>
                <div class="form-floating">
                    <textarea name="editDescripcion" class="form-control" id="floatingTextarea">{{$tipoDeIngresoEditar->descripcion}}</textarea>
                    <label for="floatingTextarea">Descripción</label>
                </div>
            </div>

            <div class="mb-3">
                <a href="{{ route('vertiposingreso') }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            </div>

        </form>

    </div>
    
@endsection