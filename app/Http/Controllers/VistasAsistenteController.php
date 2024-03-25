<?php

namespace App\Http\Controllers;

use App\Models\Constancias;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class VistasAsistenteController extends Controller
{
    // -------------------- FUNCIONES PARA PODER REGISTRAR LAS CONSTANCIAS EN EL USUARIO ASISTENTE  --------------------------------
        public function vistaCrearConstancia()
        {
            return view('VistasAsistente/asistenteRegistroConstancia');
        }

        public function guardarConstancias(Request $datosConstancias)
        {
            $datosSeleccionados = $datosConstancias->input('checkboxDatos');

            $fechaActual = date('Y-m-d');

            // Verificar si hay datos seleccionados
            if (!empty($datosSeleccionados)) {

                foreach ($datosSeleccionados as $dato) {
                    // Crear un nuevo objeto Constancias y asignar el valor del checkbox
                    $constancia = new Constancias();
                    $constancia->tipoConstancia = $dato;  // Asigna el valor que corresponde a tu modelo
                    $constancia->fechaRegistro = $fechaActual;

                    // Guardar el nuevo registro en la base de datos
                    $constancia->save();
                }

                return back()->with('resGuardarConstancias', 'Las constancias se han guradado correctamente');
                
            } else {
                
                return back()->with('resNoGuardarConstancias', 'Las constancias no se registraron');
            }
        }

        public function verInformeConstancias()
        {
            return view('VistasAsistente/asistenteGestionConstancias');
        }

        public function totalConstancias(Request $fechasFiltro){


            // Obtén los totales agrupados por tipo de constancia, filtrando por rango de fechas
            $totalesPorTipo = Constancias::select('tipoConstancia', DB::raw('count(*) as total'))
            ->whereBetween('fechaRegistro', [$fechasFiltro->fechaInicialConstancia, $fechasFiltro->fechaFinalConstancia])
            ->groupBy('tipoConstancia')
            ->get();

            // Calcula el total general
            $totalGeneralConstancias = $totalesPorTipo->sum('total');

            return view('VistasAsistente/asistenteEstadisticasConstancias', [
                'totalConstancias' => $totalesPorTipo,
                'fechaInicial' => $fechasFiltro->fechaInicialConstancia,
                'fechaFinal' => $fechasFiltro->fechaFinalConstancia,
                'totalGeneral' => $totalGeneralConstancias
            ]);

        }
    // ------------------------------------------------------------------------------------------------------------------------------


    // ------------------- FUNCIONES PARA EDITAR LOS DATOS DE USUARIO CON ROL ASISTENTE --------------------------------------------------
        public function editarDatosUsuario(Request $request, $id){
                
            $usuario = User::find($id);

            if (!$usuario) {
                // Manejar el caso donde el usuario no existe
                return back()->with('errorUsuario', 'Usuario no encontrado');
            }

            $usuario->name = $request->Nombre;
            $usuario->email = $request->Correo; 
            $usuario->save();
            return back()->with('successDatosPerfil', 'Perfil actualizado correctamente');
        }

        public function cambiarPassword(Request $request, $id)
        {
            $usuario = User::find($id);

            if (!$usuario) {
                
                return back()->with('errorUsuario', 'Usuario no encontrado');
            }

            $passActual = $request->passwordActual;

            if (Hash::check($passActual, $usuario->password)) {

                $usuario->password = Hash::make($request->newPassword);
                $usuario->save();
                return back()->with('passActulizada', 'Contraseña actulizada correctamente');
            }

            return back()->with('passError', 'La contraseña actual no es la correcta');

        }
    //------------------------------------------------------------------------------------------------------------------------------------

}
