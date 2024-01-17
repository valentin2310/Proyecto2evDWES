<?php

namespace App\Http\Controllers;

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

    public function store(Request $request): RedirectResponse
    {

        $validated = $request->validate([
            'id_cliente' => 'required',
            'id_operario' => 'required',
            'descripcion' => 'required|min:3',
            'contacto' => 'required|min:3',
            'telefono' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9', // sólo números, y caracteres de separación (espacio, guión, y otros que estiméis oportuno).
            'cod_postal' => 'digits:5', //debe tener un formato válido, 5 números.
            'correo' => 'required|email:rfc,filter', // debe tener un formato correcto
            'fecha_realizacion' => 'date_format:d/m/Y|after:today', // debe tener un formato válido y ser posterior a la fecha actual. Se debe admitir una cadena con el formato d/m/aa.
        ]);

        $tarea = new Tarea();

        $tarea->id_operario = $request->input('id_operario');
        $tarea->id_provincia = $request->input('id_provincia');
        $tarea->id_cliente = $request->input('id_cliente');

        $tarea->estado = 'P';
        $tarea->nif = $request->input('nif');
        $tarea->contacto = $request->input('contacto');
        $tarea->descripcion = $request->input('descripcion');
        $tarea->correo = $request->input('correo');
        
       /*  $tarea->telefono = $request->input('telefono');
        $tarea->telefono = $request->input('telefono');
        $tarea->telefono = $request->input('telefono');
        $tarea->telefono = $request->input('telefono'); */

        $tarea->save();

        return redirect()->route('tareas.show', $tarea);

    }
}
