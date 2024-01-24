<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmpleadoRequest;
use App\Models\Empleado;
use Illuminate\Http\RedirectResponse;
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

    public function store(StoreEmpleadoRequest $request): RedirectResponse
    {
        $request->validated();
        Empleado::create($request->all());

        return redirect()->route('empleados.show');
    }

    public function edit(Empleado $empleado)
    {
        return view('empleados/edit', compact('empleado'));
    }

    public function update(StoreEmpleadoRequest $request, Empleado $empleado)
    {      
        $request->validated();
        $empleado->update($request->all());

        return redirect()->route('empleados.show');
    }
}
