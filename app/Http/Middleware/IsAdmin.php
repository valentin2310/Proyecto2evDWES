<?php
/**
 * @author Valentin Andrei Culea
 * @version 2
 */
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Este middleware verifica que el usuario es admin
 *
 */
class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Si el usuario no está registrado o no es de tipo administrador es redirigido a la página de inicio
        if (!$request->user() || !$request->user()->esAdmin()){
            return redirect('/');
        }

        return $next($request);
    }
}
