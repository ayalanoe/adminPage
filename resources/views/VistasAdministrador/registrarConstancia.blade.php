@extends('Layouts.dashboard')

<!--Titulo de la pagina, es decir el que aparece en la pestaña, recibe dos parametros
    el parametro 'titulo' es obligatorio y el otro parametro es el nombre que queramos que aparezca en la pestaña
-->
@section('titulo', '- Registro de Constancias') 

@section('css')
    <link rel="stylesheet" href="{{ asset('css/cssAdministrador/registrarConstancia.css') }}">
@endsection

@section('contenido')

<h2>REGISTRO DE CONSTANCIAS EMITIDAS</h2>
<div class="row g-0 w-100">
  <div class="col-12 col-md-12 d-flex">       
    
    <form class="d-flex col-md formRegistrarConstancias" action="{{ route('registrarConstancias') }}" method="post">
      @csrf
      <div class="col-6">
          <div class="p-3 m-1"> <!--Padding y margin del texto-->
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
                  <td><input class="form-check-input" type="checkbox" value="Constancia 60%" name="checkboxDatos[]" id="flexChecksocialService"></td>
                </tr>
                <tr>
                  <th scope="row">2</th>
                  <td><label class="form-check-label" for="flexCheckISSS">ISSS</label></td>
                  <td><input class="form-check-input" type="checkbox" value="Constancia ISSS" name="checkboxDatos[]" id="flexCheckISSS"></td>
                </tr>
                <tr>
                  <th scope="row">3</th>
                  <td><label class="form-check-label" for="flexCheckINPEP">INPEP</label></td>
                  <td><input class="form-check-input" type="checkbox" value="Constancia INPEP" name="checkboxDatos[]" id="flexCheckINPEP"></td>
                </tr>
                <tr>
                  <th scope="row">4</th>
                  <td><label class="form-check-label" for="flexCheckISBM">ISBM</label></td>
                  <td><input class="form-check-input" type="checkbox" value="Constancia ISBM" name="checkboxDatos[]" id="flexCheckISBM"></td>
                </tr>
                <tr>
                  <th scope="row">5</th>
                  <td><label class="form-check-label" for="flexCheckAFPCrecer">AFP Crecer</label></td>
                  <td><input class="form-check-input" type="checkbox" value="Constancia AFP-Crecer" name="checkboxDatos[]" id="flexCheckAFPCrecer"></td>
                </tr>
                <tr>
                  <th scope="row">6</th>
                  <td><label class="form-check-label" for="flexCheckAFPConfía">AFP Confía</label></td>
                  <td><input class="form-check-input" type="checkbox" value="Constancia AFP-Confia" name="checkboxDatos[]" id="flexCheckAFPConfía"></td>
                </tr>
                <tr>
                  <th scope="row">7</th>
                  <td><label class="form-check-label" for="flexCheckEmbassy">Embajada</label></td>
                  <td><input class="form-check-input" type="checkbox" value="Constancia Embajada" name="checkboxDatos[]" id="flexCheckEmbassy"></td>
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
                <th scope="col">#</th>
                <th scope="col">Tipo de Constancia</th>
                <th scope="col">Acción</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">8</th>
                <td><label class="form-check-label" for="flexCheckPartialNotes">Record de notas Parciales</label></td>
                <td><input class="form-check-input" type="checkbox" value="Constancia Parciales" name="checkboxDatos[]" id="flexCheckPartialNotes"></td>
              </tr>
              <tr>
                <th scope="row">9</th>
                <td><label class="form-check-label" for="flexCheckGlobalNotesE">Record de notas Globales egresado</label></td>
                <td><input class="form-check-input" type="checkbox" value="Constancia Globales Egresados" name="checkboxDatos[]" id="flexCheckGlobalNotes"></td>
              </tr>
              <tr>
                <th scope="row">10</th>
                <td><label class="form-check-label" for="flexCheckGlobalNotesG">Record de notas Globales graduado</label></td>
                <td><input class="form-check-input" type="checkbox" value="Constancia Notas Globales Graduado" name="checkboxDatos[]" id="flexCheckGlobalNotesG"></td>
              </tr>
              <tr>
                <th scope="row">11</th>
                <td><label class="form-check-label" for="flexCheckSubjects">Comprobante de Inscripción Materias</label></td>
                <td><input class="form-check-input" type="checkbox" value="Constancia Inscripcion Materias" name="checkboxDatos[]" id="flexCheckSubjects"></td>
              </tr>
              <tr>
                <th scope="row">12</th>
                <td><label class="form-check-label" for="fCGraduationProcess">Comprobante de Inscripción Proceso de Graduación</label></td>
                <td><input class="form-check-input" type="checkbox" value="Constancia Proceso Graduacion" name="checkboxDatos[]" id="fCGraduationProcess"></td>
              </tr>
              <tr>
                <th scope="row">13</th>
                <td><label class="form-check-label" for="flexCheckEgress">Reposición de carta de egreso</label></td>
                <td><input class="form-check-input" type="checkbox" value="Constancia Reposicion Carta Egreso" name="checkboxDatos[]" id="flexCheckEgress"></td>
              </tr>
              <tr>
                <th scope="row">14</th>
                <td><label class="form-check-label" for="flexCheckGraduationDate">Comprobante de fecha de graduación</label></td>
                <td><input class="form-check-input" type="checkbox" value="Constancia Fecha Graduacion" name="checkboxDatos[]" id="flexCheckGraduationDate"></td>
              </tr>
            </tbody>
          </table>  
        </div>
      </div>

    </div>
      <div class="col-12">
        <div class="p-3 m-1">
          <button type="submit" class="btn btn-primary">Guardar Registro</button>
      </div>
    </div>
      
    </form>
    

</div>


@endsection

@section('jsVistasAdmin')


  <script>
    $('.formRegistrarConstancias').on('submit', function(e){

      var checkboxes = $("input[name='checkboxDatos[]']:checked");
        
      if (checkboxes.length === 0) {
        e.preventDefault(); // Evita el envío del formulario si ningún checkbox está seleccionado
        Swal.fire({
          title: "Seleccione al menos un elemento",
          text: "Por favor, seleccione al menos un elemento antes de enviar el formulario",
          icon: "error"
        });
      }
      else{
        
        e.preventDefault();
        Swal.fire({
            title: "Seguro de registrar",
            text: "¿Seguro que ha seleccionado las constancias correctas?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, Registrar"
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit()
            } 
        });

      }
    })
  </script>

  @if (Session::has('resGuardarConstancias'))
  <script>
      Swal.fire({
          title: "Informacion",
          text: "{{ session('resGuardarConstancias') }}",
          icon: "success"
      });
  </script>  
  @endif

  @if (Session::has('resNoGuardarConstancias'))
  <script>
      Swal.fire({
          title: "Informacion",
          text: "{{ session('resNoGuardarConstancias') }}",
          icon: "error"
      });
  </script>  
  @endif

@endsection

