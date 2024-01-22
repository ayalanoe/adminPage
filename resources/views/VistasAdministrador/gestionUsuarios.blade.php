@extends('Layouts.dashboard')
@section('contenido')
    <div>
    <h2>Otra Vista</h2>
    <p>Contenido de otra vista...</p>
    <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Usuario</th>
                <th scope="col">Correo Electrónico</th>
                <th scope="col">Acciones</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td><button type="button" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                    <button type="button" class="btn btn-secondary">Reestablecer Contraseña</button></td>
              </tr>
              <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
              </tr>
              <tr>
                <th scope="row">3</th>
                <td colspan="2">Larry the Bird</td>
                <td>@twitter</td>
              </tr>
            </tbody>
   
      </table>
</div>
@endsection