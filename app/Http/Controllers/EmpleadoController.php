<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    public function show()
    {
        return view('empleados/show', [
            'empleados' => Empleado::paginate(10)
        ]);
    }

    public function create()
    {
        return view('empleados/create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nif' => 'required',
            'nombre' => 'required|min:3',
            'correo' => 'required|email:rfc,filter', // debe tener un formato correcto
            'telefono' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9', // sólo números, y caracteres de separación (espacio, guión, y otros que estiméis oportuno).
            'tipo' => 'required|regex:/^[01]{1}$/',
            'passwd' => 'required|min:3|same:passwd_2',
            'passwd_2' => 'required|min:3'
        ]);

        $empleado = Empleado::create($request->all());

        return $empleado;
    }
}
