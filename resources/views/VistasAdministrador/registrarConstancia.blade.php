@extends('Layouts.dashboard')

<!--Titulo de la pagina, es decir el que aparece en la pestaña, recibe dos parametros
    el parametro 'titulo' es obligatorio y el otro parametro es el nombre que queramos que aparezca en la pestaña
-->
@section('titulo', '- Registro de Constancias') 

@section('css')
    <link rel="stylesheet" href="{{ asset('css/cssAdministrador/registroUsuarios.css') }}">
@endsection

@section('contenido')

<h2>REGISTRO DE CONSTANCIAS EMITIDAS</h2>
        

<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Tipo de Constancia</th>
      <th scope="col">Acción</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td><label class="form-check-label" for="flexChecksocialService">Servicio Social 60%</label></td>
      <td><input class="form-check-input" type="checkbox" value="socialService" id="flexChecksocialService"></td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td><label class="form-check-label" for="flexCheckISSS">ISSS</label></td>
      <td><input class="form-check-input" type="checkbox" value="recordISSS" id="flexCheckISSS"></td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td><label class="form-check-label" for="flexCheckINPEP">INPEP</label></td>
      <td><input class="form-check-input" type="checkbox" value="recordINPEP" id="flexCheckINPEP"></td>
    </tr>
    <tr>
      <th scope="row">4</th>
      <td><label class="form-check-label" for="flexCheckISBM">ISBM</label></td>
      <td><input class="form-check-input" type="checkbox" value="recordISBM" id="flexCheckISBM"></td>
    </tr>
    <tr>
      <th scope="row">5</th>
      <td><label class="form-check-label" for="flexCheckAFPCrecer">AFP Crecer</label></td>
      <td><input class="form-check-input" type="checkbox" value="recordAFPCrecer" id="flexCheckAFPCrecer"></td>
    </tr>
    <tr>
      <th scope="row">6</th>
      <td><label class="form-check-label" for="flexCheckAFPConfía">AFP Confía</label></td>
      <td><input class="form-check-input" type="checkbox" value="recordAFPConfía" id="flexCheckAFPConfía"></td>
    </tr>
    <tr>
      <th scope="row">7</th>
      <td><label class="form-check-label" for="flexCheckEmbassy">Embajada</label></td>
      <td><input class="form-check-input" type="checkbox" value="recordEmbassy" id="flexCheckEmbassy"></td>
    </tr>
    <tr>
      <th scope="row">8</th>
      <td><label class="form-check-label" for="flexCheckPartialNotes">Record de notas Parciales</label></td>
      <td><input class="form-check-input" type="checkbox" value="recordPartial" id="flexCheckPartialNotes"></td>
    </tr>
    <tr>
      <th scope="row">9</th>
      <td><label class="form-check-label" for="flexCheckGlobalNotesE">Record de notas Globales egresado</label></td>
      <td><input class="form-check-input" type="checkbox" value="recordGlobal" id="flexCheckGlobalNotes"></td>
    </tr>
    <tr>
      <th scope="row">10</th>
      <td><label class="form-check-label" for="flexCheckGlobalNotesG">Record de notas Globales graduado</label></td>
      <td><input class="form-check-input" type="checkbox" value="recordGlobalNotesG" id="flexCheckGlobalNotesG"></td>
    </tr>
    <tr>
      <th scope="row">11</th>
      <td><label class="form-check-label" for="flexCheckSubjects">Comprobante de Inscripción Materias</label></td>
      <td><input class="form-check-input" type="checkbox" value="recordSubjects" id="flexCheckSubjects"></td>
    </tr>
    <tr>
      <th scope="row">12</th>
      <td><label class="form-check-label" for="fCGraduationProcess">Comprobante de Inscripción Proceso de Graduación</label></td>
      <td><input class="form-check-input" type="checkbox" value="recordGraduation" id="fCGraduationProcess"></td>
    </tr>
    <tr>
      <th scope="row">13</th>
      <td><label class="form-check-label" for="flexCheckEgress">Reposición de carta de egreso</label></td>
      <td><input class="form-check-input" type="checkbox" value="recordEgress" id="flexCheckEgress"></td>
    </tr>
    <tr>
      <th scope="row">14</th>
      <td><label class="form-check-label" for="flexCheckGraduationDate">Comprobante de fecha de graduación</label></td>
      <td><input class="form-check-input" type="checkbox" value="recordGraduationDate" id="flexCheckGraduationDate"></td>
    </tr>
  </tbody>
</table>

<button type="submit" class="btn btn-primary" id="btnSaveRecord">Guardar Registro</button>

@endsection

@section('jsVistasAdmin')

@endsection

