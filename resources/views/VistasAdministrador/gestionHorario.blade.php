@extends('Layouts.dashboard')

@section('titulo', '- Horario De Atención')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/cssAdministrador/gestionHorario.css')}}">   
    <link rel="stylesheet" href="{{ asset('css/cssAdministrador/textoGestionGlobal.css') }}">
@endsection

@section('contenido')

    <h2>Horario de Atención - {{date('Y')}}</h2>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Dias Laborales</th>
                <th scope="col">Hora de Apertura</th>
                <th scope="col">Hora de Cierre</th>
                <th scope="col">Estado Mediodía</th>
                <th scope="col">Accion</th>
                
            </tr>
        </thead>

        <tbody>

            @php
                $numero = 1
            @endphp

            @forelse ($horarioAtencion as $horario)
                <tr>
                    <th>{{$numero}}</th>
                    <td> {{$horario->diasLaborales}} </td>
                    <td> {{$horario->horaInicio}} </td>
                    <td> {{$horario->horaCierre}} </td>
                    <td> {{$horario->estadoMedioDia}} </td>
                    <td>-</td>
                </tr>

                @php
                    $numero++
                @endphp
                
            @empty
                
            <tr>
                <th>1</th>
                <td>Asignar horario de Atención</td>
                <td>--</td>
                <td>--</td>
                <td>--</td>
                <td colspan="3">
                    <a class="btn btn-secondary" href="calendarioAcademico" data-bs-toggle="modal" data-bs-target="#asignarHorarioA"><i class="fa-solid fa-plus"></i> Asignar Horario</a>
                </td>
            </tr>                
            @endforelse

        </tbody>
    </table>

    @if (!$horarioAtencion->isEmpty())
        <div class="container">
            <form action="{{ route('eliminarHorarioAtencion')}}" class="formEliminarHorarioAtencion" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger mx-1"><i class="fa-solid fa-trash"></i> Eliminar Horario</button>
            </form>
        </div>
    @endif
    

@endsection

@section('jsVistasAdmin')

    @if (Session::has('resHorarioAtencion'))
    <script>
        Swal.fire({
            title: "Informacion",
            text: "{{ session('resHorarioAtencion') }}",
            icon: "success"
        });
    </script>  
    @endif

    @if (Session::has('resEliminarHorarioAtencion'))
    <script>
        Swal.fire({
            title: "Informacion",
            text: "{{ session('resEliminarHorarioAtencion') }}",
            icon: "success"
        });
    </script>  
    @endif
    
    <script>
        $('.formEliminarHorarioAtencion').on('submit', function(e){
            e.preventDefault();

            Swal.fire({
                title: "¿Está seguro?",
                text: "Se eliminará el horario de atencion",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, eliminar"
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit()
                } 
            });

        })
    </script>
@endsection



@section('modales')

    <!-- MOdal para ingresar el horario de atencion de la Administracion Academica -->
    <div class="modal fade" id="asignarHorarioA" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Asignación de Horario de Atención</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    

                    <form action="{{ route('registrarHorarioAtencion') }}" method="POST" class="row g-3 needs-validation" novalidate>
                        @csrf

                        <div class="col-md-12">
                            <label for="validationCustomUser" class="form-label">Días de Atención</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-calendar-days"></i></span>
                                <input name="diasNormalAtencion" type="text" class="form-control" required>
                                <div class="invalid-feedback">
                                    Campo vacío!
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <label for="validationCustomUser" class="form-label">Apertura</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-door-closed"></i></span>
                                <input name="normalHoraInicio" type="time" class="form-control" required>
                                <div class="invalid-feedback">
                                    Campo vacío !
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label for="validationCustomUser" class="form-label">Cierre</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-door-closed"></i></span>
                                <input name="normalHoraCierre" type="time" class="form-control" id="horaCierre" required>
                                <div class="invalid-feedback">
                                    Campo vacío !
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label for="validationCustomCorreo" class="form-label">Estado al Mediodía</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-lock"></i></span>
                                <select name="estadoMediodia" class="form-select" aria-describedby="inputGroupPrepend" required>
                                    <option value="" selected disabled>Seleccione una opción</option>
                                    <option value="abierto">* Abierto al mediodía</option>
                                    <option value="cerrado">* Cerrado al mediodía</option>
                                </select>
                                <div class="invalid-feedback">
                                    Seleccione una opción
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label for="validationCustomUser" class="form-label">Otro dia de atencion</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-calendar-days"></i></span>
                                <input name="otroDiaAtencion" type="text" class="form-control" required>
                                <div class="invalid-feedback">
                                    Campo vacío !
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label for="validationCustomUser" class="form-label">Apertura</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-door-closed"></i></span>
                                <input name="otroDiaHoraInicio" type="time" class="form-control" required>
                                <div class="invalid-feedback">
                                    Campo vacío !
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label for="validationCustomUser" class="form-label">Cierre</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-door-closed"></i></span>
                                <input name="otroDiaHoraCierre" type="time" class="form-control" id="horaCierre" required>
                                <div class="invalid-feedback">
                                    Campo vacío!
                                </div>
                            </div>
                        </div>
                        

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Guardar Horario</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection

