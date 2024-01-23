@extends('Layouts.dashboard')
@section('contenido')
    <h2>Otra Vista</h2>
    <p>Contenido de otra vista...</p>
    <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Correo Electrónico</th>
                <th scope="col">Acciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($usuarios as $usuario)
                <tr>
                  <th scope="row">{{$usuario->id}}</th>
                  <td>{{$usuario->name}}</td>
                  <td>{{$usuario->email}}</td>
                  <td>

                    <form class="fluid" action="{{route('usuarios.destroy', $usuario->id) }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                    </form>
                    
                    <form action="{{ route('resetPass', $usuario->id)}}" method="POST">
                      @csrf
                      <button type="submit" class="btn btn-secondary">Reestablecer Contraseña</button>
                    </form>
                    
                  </td>
                </tr>
              @endforeach
            </tbody>
   
      </table>
@endsection