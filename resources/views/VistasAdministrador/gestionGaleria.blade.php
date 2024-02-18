@extends('Layouts.dashboard')

@section('titulo', '- Galería Institucional')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/cssAdministrador/calendarioAdministrativo.css')}}">   
@endsection

@section('contenido')
    
    <br><br>

    <h2>Galería Institucional - {{date('Y')}}</h2>
    
    <table class="table table-hover">
        <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nombre de la Foto</th>
              <th scope="col">Fecha de Publicación</th>
              <th scope="col">Acciones</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">1</th>
              <td>Mark</td>
              <td>Otto</td>
              <td>@mdo</td>
            </tr>
            
          </tbody>
      </table>

      <div class="container">
        <button type="submit" class="btn btn-success mx-1" data-bs-toggle="modal" data-bs-target="#ModalCrearFacultades"><i class="fa-solid fa-user-plus"></i> Agregar Foto</button>
      </div>
@endsection

