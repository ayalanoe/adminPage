@extends('Layouts.dashboardAsistente')

<!--Titulo de la pagina, es decir el que aparece en la pestaña, recibe dos parametros
    el parametro 'titulo' es obligatorio y el otro parametro es el nombre que queramos que aparezca en la pestaña
-->
@section('titulo', '- Informe de Constancias') 

@section('css')
    <link rel="stylesheet" href="{{ asset('css/cssAdministrador/gestionConstancias.css') }}">
@endsection

@section('contenido')

<h2>FILTRAR INFORME DE CONSTANCIAS</h2>

    <div class="col-12">
      <div class="p-3 m-1"> <!--Padding y margin del texto-->           
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">Fecha Inicial</th>
              <th scope="col">Fecha Final</th>
              <th scope="col">Acción</th>
            </tr>
          </thead>
          <form method="post" action="{{ route('totalConstanciasAsis') }}" onsubmit="return validarFechas()">
            @csrf
            <tbody>
                <tr>
                    <th scope="row">
                        <input name="fechaInicialConstancia" type="date" class="form-control" placeholder="Fecha Inicial" style="width: 200px;">
                    </th>
                    <td>
                        <input name="fechaFinalConstancia" type="date" class="form-control" placeholder="Fecha Final" style="width: 200px;">
                    </td>
                    <td>
                        <button type="submit" class="btn btn-secondary" id="btnGenerarInforme">Generar Informe</button>
                    </td>
                </tr>
            </tbody>
        </form>
        </table>
      </div>
    </div>  

@endsection

@section('jsVistasAdmin')

  <script>
    function validarFechas() {
        var fechaInicial = document.getElementsByName('fechaInicialConstancia')[0].value;
        var fechaFinal = document.getElementsByName('fechaFinalConstancia')[0].value;

        if (fechaInicial === "" || fechaFinal === "") {
          Swal.fire({
            title: "Informacion",
            text: "No se han ingresado las fechas",
            icon: "error"
          });
            return false;
        }

        return true;
    }
  </script>

@endsection

