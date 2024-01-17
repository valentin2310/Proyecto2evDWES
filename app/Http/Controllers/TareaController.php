<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTareaRequest;
use App\Models\Cliente;
use App\Models\Empleado;
use App\Models\Provincia;
use App\Models\Tarea;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TareaController extends Controller
{
    public function index()
    {
        return view('tareas/index', [
            'tareas' => Tarea::paginate(10)
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
            'listaProvincias' => Provincia::all(),
            'listaOperarios' => Empleado::getOperarios(),
            'listaClientes' => Cliente::all()
        ]);
    }

    public function store(StoreTareaRequest $request): RedirectResponse
    {
        $request->validated();

        $tarea = new Tarea();
        $tarea->asignarValores($request);
        $tarea->save();

        return redirect()->route('tareas.show', $tarea);

    }
}
