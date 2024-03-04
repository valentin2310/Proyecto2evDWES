<?php
/**
 * @author Valentin Andrei Culea
 * @version 2
 */

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Muestra la vista para iniciar sesión
     * 
     * @return mixed
     */
    public function index(){
        return view('login');
    }
    /**
     * Comprueba las credenciales del usuario
     * Si son correctas se actualiza el ultimo login y redirige a la ruta que quería acceder
     * En caso de que sean incorrectos redirige al usuario a la página origen con los errores.
     * 
     * @return RedirectResponse
     */
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'correo' => ['required', 'email'],
            'password' => ['required']
        ]);

        // Intenta iniciar sesión con las credenciales
        if (Auth::attempt($credentials, $request->recordar ?? false)){
            $request->session()->regenerate();

            Empleado::find(Auth::id())->update(['ultimo_login' => now()]);

            return redirect()->intended();
        }

        // Redirige al usuario de vuelta con los errores
        return back()->withErrors([
            'correo' => 'Los datos de acceso no son correctos.'
        ])->onlyInput('correo');
    }
    /**
     * Cierra la sesión del usuario
     * Quita las varibles de sesión de inicio de sesión
     * 
     * @return RedirectResponse
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
