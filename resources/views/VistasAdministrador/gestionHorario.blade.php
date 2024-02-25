@extends('Layouts.dashboard')

@section('titulo', '- Horario De Atención')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/cssAdministrador/calendarioAdministrativo.css')}}">   
@endsection

@section('contenido')
    
    <br><br>

    <h2>Horario de Atención - {{date('Y')}}</h2>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Días de Atención</th>
                <th scope="col">Hora de Apertura</th>
                <th scope="col">Días de Cierre</th>
                <th scope="col">Estado Mediodía</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>

        <tbody>
        
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

        </tbody>
    </table>

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
                    

                    <form action="{{route('subirCalAdmin')}}" method="POST" enctype="multipart/form-data" class="row g-3 needs-validation" novalidate>
                        @csrf

                        <div class="col-md-12">
                            <label for="validationCustomUser" class="form-label">Días de Atención</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-calendar-days"></i></span>
                                <input name="nombreArchivo" type="text" class="form-control" id="nombreCalendarioAcademico" required>
                                <div class="valid-feedback">
                                    Nombre valido!
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <label for="validationCustomUser" class="form-label">Apertura</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-door-closed"></i></span>
                                <input name="horaCierre" type="time" class="form-control" id="horaCierre" required>
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
                                <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-lock"></i> <i class="fa-solid fa-unlock"></i></span>
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

