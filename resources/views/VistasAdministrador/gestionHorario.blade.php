@extends('Layouts.dashboard')

@section('titulo', '- Horario De Atención')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/cssAdministrador/gestionHorario.css')}}">   
@endsection

@section('contenido')
    
    <br><br>

    <h2>Horario de Atención - {{date('Y')}}</h2>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Dias Laborales</th>
                <th scope="col">Hora de Apertura</th>
                <th scope="col">Hora de Cierre</th>
                <th scope="col">Estado Mediodía</th>
                <th scope="col">Otros dias</th>
                <th scope="col">Hora Apertura</th>
                <th scope="col">Hora Cierre</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>

        <tbody>

            @forelse ($horarioAtencion as $horario)
                <tr>
                    <th>1</th>
                    <td> {{$horario->dias}} </td>
                    <td> {{$horario->horaInicio}} </td>
                    <td> {{$horario->horaCierre}} </td>
                    <td> {{$horario->estadoMediodia}} </td>
                    <td> {{$horario->otrosDias}} </td>
                    <td> {{$horario->horaInicioOtro}} </td>
                    <td> {{$horario->horaCierreOtro}} </td>
                    <td colspan="3">
                        <form action="{{ route('eliminarHorarioAtencion', $horario->id) }}" class="formEliminarHorarioAtencion" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger mx-1"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                
            @empty
                
            <tr>
                <th>1</th>
                <td>Asignar horario de Atención</td>
                <td>--</td>
                <td>--</td>
                <td>--</td>
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

    <!-- Modal para subir el calendario administrativo ciclo-1 -->
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
                                <input name="diasAtecion" type="text" class="form-control" required>
                                <div class="valid-feedback">
                                    Dia valido!
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <label for="validationCustomUser" class="form-label">Apertura</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-door-closed"></i></span>
                                <input name="horaInicio" type="time" class="form-control" required>
                                <div class="valid-feedback">
                                    Hora válida!
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label for="validationCustomUser" class="form-label">Cierre</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-door-closed"></i></span>
                                <input name="horaCierre" type="time" class="form-control" id="horaCierre" required>
                                <div class="valid-feedback">
                                    Hora válida!
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
                            <label for="validationCustomUser" class="form-label">Otros dias de atencion</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-calendar-days"></i></span>
                                <input name="otrosDias" type="text" class="form-control" required>
                                <div class="valid-feedback">
                                    Dia valido!
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label for="validationCustomUser" class="form-label">Apertura</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-door-closed"></i></span>
                                <input name="otroHoraInicio" type="time" class="form-control" required>
                                <div class="valid-feedback">
                                    Hora válida!
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label for="validationCustomUser" class="form-label">Cierre</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-door-closed"></i></span>
                                <input name="OtroHoraCierre" type="time" class="form-control" id="horaCierre" required>
                                <div class="valid-feedback">
                                    Hora válida!
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

