<?php
/**
 * @author Valentin Andrei Culea
 * @version 2
 */

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmpleadoRequest;
use App\Models\Empleado;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
     /**
     * Mostrar todos los empleados paginadas
     * 
     * @return mixed
     */
    public function show()
    {
        return view('empleados/show', [
            'empleados' => Empleado::paginate(10)
        ]);
    }
    /**
     * Muestra la vista para crear un empleado, 
     * 
     * @return mixed
     */
    public function create()
    {
        return view('empleados/create');
    }
    /**
     * Valida los campos del formulario
     * Guarda el empleado en la bd
     * 
     * @return RedirectResponse
     */
    public function store(StoreEmpleadoRequest $request): RedirectResponse
    {
        $request->validated();
        Empleado::create($request->all());

        return redirect()->route('empleados.show');
    }
    /**
     * Muestra la vista con el formulario para editar el empleado,
     * 
     * @return mixed
     */
    public function edit(Empleado $empleado)
    {
        return view('empleados/edit', compact('empleado'));
    }
     /**
     * Valida los campos del formulario
     * Actualiza el empleado en la bd
     * 
     * @return RedirectResponse
     */
    public function update(StoreEmpleadoRequest $request, Empleado $empleado)
    {      
        $request->validated();
        $empleado->update($request->all());

        return redirect()->route('empleados.show');
    }
    /**
     * Muestra la vista de confirmación para eliminar el empleado
     * 
     * @return mixed
     */
    public function delete(Empleado $empleado)
    {
        return view('empleados/confirmacion', compact('empleado'));
    }
    /**
     * Elimina el empleado
     * Redirige al usuario a otra vista con los resultados de la operación de eliminar.
     * 
     * @return RedirectResponse
     */
    public function destroy(Empleado $empleado)
    {
        $resultado = $empleado->delete();

        return redirect()->route('info', [
            'title' => 'Eliminar el empleado '.$empleado->nombre,
            'body' => $resultado ? 'El empleado se ha eliminado exitosamente.' : 'Hubo un error al eliminar el empleado'
        ]);
    }
}
