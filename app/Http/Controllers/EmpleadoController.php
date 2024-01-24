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

    public function delete(Empleado $empleado)
    {
        return view('empleados/confirmacion', compact('empleado'));
    }

    public function destroy(Empleado $empleado)
    {
        $resultado = $empleado->delete();

        return redirect()->route('info', [
            'title' => 'Eliminar el empleado '.$empleado->nombre,
            'body' => $resultado ? 'El empleado se ha eliminado exitosamente.' : 'Hubo un error al eliminar el empleado'
        ]);
    }
}
