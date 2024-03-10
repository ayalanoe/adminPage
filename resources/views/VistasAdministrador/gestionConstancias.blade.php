@extends('Layouts.dashboard')

<!--Titulo de la pagina, es decir el que aparece en la pestaña, recibe dos parametros
    el parametro 'titulo' es obligatorio y el otro parametro es el nombre que queramos que aparezca en la pestaña
-->
@section('titulo', '- Informe de Constancias') 

@section('css')
    <link rel="stylesheet" href="{{ asset('css/cssAdministrador/registroUsuarios.css') }}">
@endsection

@section('contenido')

<h2>INFORME DE CONSTANCIAS EMITIDAS</h2>

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
          <tbody>
            <tr>
              <th scope="row"><input name="fechaExpiracionAnuncio" type="date" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" style="width: 200px;">
              </th>
              <td><input name="fechaExpiracionAnuncio" type="date" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" style="width: 200px;">
              </td>
              <td><button type="button" class="btn btn-secondary" id="btnCancelFacultad">Generar Informe</button></div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>  


<div class="row g-0 w-100">
  <div class="col-12 col-md-12 d-flex">       
    
      <div class="col-6">
          <div class="p-3 m-1"> <!--Padding y margin del texto-->
            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">Tipo de Constancia</th>
                  <th scope="col">Cantidad</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><label class="form-check-label" for="flexChecksocialService">Servicio Social 60%</label></td>
                  <td>  </td>
                </tr>
                <tr>
                  <td><label class="form-check-label" for="flexCheckISSS">ISSS</label></td>
                  <td>  </td>
                </tr>
                <tr>
                  <td><label class="form-check-label" for="flexCheckINPEP">INPEP</label></td>
                  <td>  </td>
                </tr>
                <tr>
                  <td><label class="form-check-label" for="flexCheckISBM">ISBM</label></td>
                  <td>  </td>
                </tr>
                <tr>
                  <td><label class="form-check-label" for="flexCheckAFPCrecer">AFP Crecer</label></td>
                  <td>  </td>
                </tr>
                <tr>
                  <td><label class="form-check-label" for="flexCheckAFPConfía">AFP Confía</label></td>
                  <td>  </td>
                </tr>
                <tr>
                  <td><label class="form-check-label" for="flexCheckEmbassy">Embajada</label></td>
                  <td>  </td>
                </tr>
              </tbody>
            </table>
        </div>


      </div>                                               
      
      <div class="col-6">
        <div class="p-3 m-1"> <!--Padding y margin del texto-->
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">Tipo de Constancia</th>
                <th scope="col">Cantidad</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><label class="form-check-label" for="flexCheckPartialNotes">Record de notas Parciales</label></td>
                <td>  </td>
              </tr>
              <tr>
                <td><label class="form-check-label" for="flexCheckGlobalNotesE">Record de notas Globales egresado</label></td>
                <td>  </td>
              </tr>
              <tr>
                <td><label class="form-check-label" for="flexCheckGlobalNotesG">Record de notas Globales graduado</label></td>
                <td>  </td>
              </tr>
              <tr>
                <td><label class="form-check-label" for="flexCheckSubjects">Comprobante de Inscripción Materias</label></td>
                <td>  </td>
              </tr>
              <tr>
                <td><label class="form-check-label" for="fCGraduationProcess">Comprobante de Inscripción Proceso de Graduación</label></td>
                <td><input class="form-check-input" type="checkbox" value="recordGraduation" id="fCGraduationProcess"></td>
              </tr>
              <tr>
                <td><label class="form-check-label" for="flexCheckEgress">Reposición de carta de egreso</label></td>
                <td>  </td>
              </tr>
              <tr>
                <td><label class="form-check-label" for="flexCheckGraduationDate">Comprobante de fecha de graduación</label></td>
                <td>  </td>
              </tr>
            </tbody>
          </table>  
        </div>
      </div>

    
  </div>
</div>


<div class="row g-0 w-100">
  <div class="col-12 col-md-12 d-flex">       
    
      <div class="col-5">
          <div class="p-3 m-1"> <!--Padding y margin del texto-->
            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">Total de Constancias Emitidas: </th>
                  <th scope="col">  </th>
                </tr>
              </thead>
            </table>  
          </div>
        </div>
  
      
    </div>
  </div>
@endsection

@section('jsVistasAdmin')

@endsection

