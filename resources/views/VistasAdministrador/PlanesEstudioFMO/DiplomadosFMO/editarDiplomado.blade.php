@extends('Layouts.dashboard')
@section('titulo', '- Editar Diplomado')

@section('contenido')

    <div class="container">

        <h2 class="global-tittle">EDITAR DIPLOMADO</h2>
       
        <hr>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Imagen Informativa</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @php
                $numero = 1 
                @endphp

                <th scope="row">{{$numero}}</th>  
                @if ($diplomadoEditar->rutaArchivo)
                    <td>Archivo_Cargado</td>
                    <td class="d-flex">
                        <a href="{{ route('verPdfDiplomados', $diplomadoEditar->id) }}" class="btn btn-primary mx-1" target="_blank"><i class="fa-solid fa-eye"></i></a>
                    </td>
                @endif
            
            </tbody>
        </table>

        <form action="{{ route('actualizarDiplomado', $diplomadoEditar->id) }}" class="formNewDatosDiplomado" method="POST">
            @csrf
            
            <div class="col-md-12">
                <label for="validationCustomUser" class="form-label">Tipo de Carrera</label>
                <div class="input-group has-validation">
                    <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-bars"></i></span>
                    <input name="editDiploTipoCarrera" type="text" class="form-control" id="validaUser" value="Diplomado" readonly> <!-- La propiedad readonly permite que el input sea solo de lectura ya que disable no envia el valor del input y el objetivo es que esté deshabilitado pero que se envíe -->
                </div>
            </div>

            <br>
            <div class="col-md-12">
                <label for="validationCustomUser" class="form-label">Nombre Diplomado</label>
                <div class="input-group has-validation">
                    <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-pen-to-square"></i></span>
                    <input value="{{$diplomadoEditar->carrera}}" name="editDiploNombre" type="text" class="form-control" id="nombreCarreraTecnica">
                    <div class="valid-feedback">
                        Carrera invalida!
                    </div>
                </div>
            </div>
            
            
            <br>
            <div class="col-md-12">
                <label for="validationCustomCorreo" class="form-label">Codigo del Diplomado</label>
                <div class="input-group has-validation">
                    <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-file-lines"></i></span>
                    <input value="{{$diplomadoEditar->codigoCarrera}}" name="editDiploCodigo" type="text" class="form-control" id="codigoCarreraTecnica" aria-describedby="inputGroupPrepend">
                    <div class="invalid-feedback">
                        Codigo no valido!
                    </div>
                </div>
            </div>

            <br>
            <div class="col-md-12">
                <label for="validationCustomCorreo" class="form-label">Departamento</label>
                <input value="{{$diplomadoEditar->departamento}}" name="editDiploDepto" class="form-control" list="datalistOptions" readonly>
                <datalist id="datalistOptions">
                    <option value="EPOS" label="Posgrado"></option>
                </datalist>
            </div>

            <br>
            <a href="{{ route('verListaDiplomados') }}" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
        
    </div>
    
@endsection