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
}
