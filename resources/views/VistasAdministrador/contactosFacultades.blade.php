@extends('Layouts.dashboard')
@section('titulo', '- Contactos Facultades')

@section('contenido')
<div class="container">
    <h2>Contactos de facultades</h2>
    
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Facultad</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>

            <tr>
                <th>1</th>
                <td>Facultad de Medicina</td>
                <td>
                    <a href=" {{route('gestionFacultades', ['facultad' => 'Facultad de Medicina']) }} " class="btn btn-primary mx-1">Ver Contactos de Facultad <i class="fa-solid fa-circle-arrow-right"></i></a>
                </td>
            </tr>

            <tr>
                <th>2</th>
                <td>Facultad de Jurisprudencia y Ciencias Sociales</td>
                <td>
                    <a href=" {{route('gestionFacultades', ['facultad' => 'Facultad de Jurisprudencia y Ciencias Sociales']) }} " class="btn btn-primary mx-1">Ver Contactos de Facultad <i class="fa-solid fa-circle-arrow-right"></i></a>
                </td>
            </tr>

            <tr>
                <th>3</th>
                <td>Facultad de Ciencias Agronómicas</td>
                <td>
                    <a href=" {{route('gestionFacultades', ['facultad' => 'Facultad de Ciencias Agronómicas']) }} " class="btn btn-primary mx-1">Ver Contactos de Facultad <i class="fa-solid fa-circle-arrow-right"></i></a>
                </td>
            </tr>

            <tr>
                <th>4</th>
                <td>Facultad de Ciencias y Humanidades</td>
                <td>
                    <a href="{{ route('gestionFacultades', ['facultad' => 'Facultad de Ciencias y Humanidades']) }}" class="btn btn-primary mx-1">Ver Contactos de Facultad <i class="fa-solid fa-circle-arrow-right"></i></a>
                </td>
            </tr>

            <tr>
                <th>5</th>
                <td>Facultad de Ingeniería y Arquitectura</td>
                <td>
                    <a href=" {{route('gestionFacultades', ['facultad' => 'Facultad de Ingeniería y Arquitectura']) }} " class="btn btn-primary mx-1">Ver Contactos de Facultad <i class="fa-solid fa-circle-arrow-right"></i></a>
                </td>
            </tr>

            <tr>
                <th>6</th>
                <td>Facultad de Química y Farmacia</td>
                <td>
                    <a href=" {{route('gestionFacultades', ['facultad' => 'Facultad de Química y Farmacia']) }} " class="btn btn-primary mx-1">Ver Contactos de Facultad <i class="fa-solid fa-circle-arrow-right"></i></a>
                </td>
            </tr>

            <tr>
                <th>7</th>
                <td>Facultad de Odontología</td>
                <td>
                    <a href=" {{route('gestionFacultades', ['facultad' => 'Facultad de Odontología']) }} " class="btn btn-primary mx-1">Ver Contactos de Facultad <i class="fa-solid fa-circle-arrow-right"></i></a>
                </td>
            </tr>

            <tr>
                <th>8</th>
                <td>Facultad de Ciencias Económicas</td>
                <td>
                    <a href=" {{route('gestionFacultades', ['facultad' => 'Facultad de Ciencias Económicas']) }} " class="btn btn-primary mx-1">Ver Contactos de Facultad <i class="fa-solid fa-circle-arrow-right"></i></a>
                </td>
            </tr>

            <tr>
                <th>9</th>
                <td>Facultad de Ciencias Naturales y Matemática</td>
                <td>
                    <a href=" {{route('gestionFacultades', ['facultad' => 'Facultad de Ciencias Naturales y Matemática']) }} " class="btn btn-primary mx-1">Ver Contactos de Facultad <i class="fa-solid fa-circle-arrow-right"></i></a>
                </td>
            </tr>

            <tr>
                <th>10</th>
                <td>Facultad Multidisciplinaria de Occidente</td>
                <td>
                    <a href=" {{route('gestionFacultades', ['facultad' => 'Facultad Multidisciplinaria de Occidente']) }} " class="btn btn-primary mx-1">Ver Contactos de Facultad <i class="fa-solid fa-circle-arrow-right"></i></a>
                </td>
            </tr>

            <tr>
                <th>11</th>
                <td>Facultad Multidisciplinaria Oriente</td>
                <td>
                    <a href=" {{route('gestionFacultades', ['facultad' => 'Facultad Multidisciplinaria Oriente']) }} " class="btn btn-primary mx-1">Ver Contactos de Facultad <i class="fa-solid fa-circle-arrow-right"></i></a>
                </td>
            </tr>

            <tr>
                <th>12</th>
                <td>Facultad Multidisciplinaria Paracentral</td>
                <td>
                    <a href=" {{route('gestionFacultades', ['facultad' => 'Facultad Multidisciplinaria Paracentral']) }} " class="btn btn-primary mx-1">Ver Contactos de Facultad <i class="fa-solid fa-circle-arrow-right"></i></a>
                </td>
            </tr>

        </tbody>
    </table>
</div>
    
@endsection