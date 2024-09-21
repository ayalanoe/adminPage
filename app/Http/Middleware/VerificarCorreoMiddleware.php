<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class VerificarCorreoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        //Se busca el id del usuario en la sesion que se ha iniciado con el correo, si el id es valido redirige normal como lo hemos establceido en el LoginController
        if (session()->has('usuarioId')) {
            return $next($request);
        }

        // Si no está presente se redirige a la página de inicio de sesión
        return redirect(route('login'))->with('error', 'Acceso no autorizado');
    }
}
