<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompletarTareaRequest;
use App\Http\Requests\StoreTareaRequest;
use App\Models\Cliente;
use App\Models\Empleado;
use App\Models\Provincia;
use App\Models\Tarea;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TareaController extends Controller
{
    public function index()
    {
        $auth = Auth::user();
        $user = Empleado::find($auth->id);

        if(!$user->esAdmin()){
            $tareas = Tarea::where('id_operario', '=', $user->id)->paginate(10);
        }else{
            $tareas = Tarea::paginate(10);
        }

        return view('tareas/index', [
            'tareas' => $tareas
        ]);
    }

    public function show(Tarea $tarea)
    {
        return view('tareas/show', compact('tarea'));
    }

    public function create()
    {
        return view('tareas/create', [
            'optionsEstado' => Tarea::OPTIONS_ESTADOS,
            'provincias' => Provincia::all(),
            'operarios' => Empleado::getOperarios(),
            'clientes' => Cliente::all()
        ]);
    }

    public function store(StoreTareaRequest $request): RedirectResponse
    {
        $request->validated();
        $tarea = Tarea::create($request->all());

        return redirect()->route('tareas.show', $tarea);

    }

    public function edit(Tarea $tarea)
    {
        return view('tareas/edit', [
            'tarea' => $tarea,
            'optionsEstado' => Tarea::OPTIONS_ESTADOS,
            'provincias' => Provincia::all(),
            'operarios' => Empleado::getOperarios(),
            'clientes' => Cliente::all()
        ]);
    }

    public function update(StoreTareaRequest $request, Tarea $tarea): RedirectResponse
    {
        $request->validated();
        $tarea->update($request->all());

        return redirect()->route('tareas.show', $tarea);
    }

    public function completar(Tarea $tarea)
    {
        return view('tareas/completar', [
            'tarea' => $tarea,
            'optionsEstado' => Tarea::OPTIONS_ESTADOS
        ]);
    }

    public function completarUpdate(CompletarTareaRequest $request, Tarea $tarea): RedirectResponse
    {
        $request->validated();

        $tarea->guardarFichero($request);
        $tarea->guardarImagenes($request);

        $tarea->update($request->all());
        
        return redirect()->route('tareas.show', $tarea);
    }

    public function delete(Tarea $tarea)
    {
        return view('tareas/confirmacion', compact('tarea'));
    }

    public function destroy(Tarea $tarea)
    {
        $tarea->eliminarArchivos();
        $resultado = $tarea->delete();

        return redirect()->route('info', [
            'title' => 'Eliminar la tarea '.$tarea->id,
            'body' => $resultado ? 'La tarea se ha eliminado exitosamente.' : 'Hubo un error al eliminar la tarea'
        ]);
    }
}
