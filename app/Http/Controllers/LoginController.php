<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function index(){
        return view('login');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'correo' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (Auth::attempt($credentials, $request->recordar ?? false)){
            $request->session()->regenerate();

            Empleado::find(Auth::id())->update(['ultimo_login' => now()]);

            return redirect()->intended();
        }

        return back()->withErrors([
            'correo' => 'Los datos de acceso no son correctos.'
        ])->onlyInput('correo');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
