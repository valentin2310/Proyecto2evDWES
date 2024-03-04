<?php
/**
 * @author Valentin Andrei Culea
 * @version 2
 */

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
     /**
     * Mostrar todas las tareas paginadas
     * Comprueba que si el usuario es operador, para mostrar solo las tareas que tiene asignadas.
     * 
     * @return mixed
     */
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
     /**
     * Mostrar todos los datos de la tarea
     * 
     * @return mixed
     */
    public function show(Tarea $tarea)
    {
        return view('tareas/show', compact('tarea'));
    }
     /**
     * Mostrar todos las tareas paginadas y permite filtrarlas por diferentes campos
     * También devuelve las opciones de los campos y criterios para rellenar los selects
     * 
     * @return mixed
     */
    public function search(Request $request)
    {
        if($request->query('valor1')){
            $campo = $request->query('campo1');
            $criterio = $request->query('criterio1');
            $valor = $request->query('valor1');

            $tareas = Tarea::where($campo, $criterio, $valor)
                ->paginate(10);
        } else {
            $tareas = Tarea::paginate(10);
        }

        return view('tareas/search', [
            'tareas' => $tareas,
            'OPTIONS_CAMPOS' => Tarea::OPTIONS_CAMPOS,
            'OPTIONS_CRITERIOS' => Tarea::OPTIONS_CRITERIOS,
        ]);
    }
    /**
     * Muestra la vista para crear una tarea, 
     * con la lista de provincias, operarios y clientes para rellenar los selects.
     * También devuelve la lista de posibles estados de la tarea.
     * 
     * @return mixed
     */
    public function create()
    {
        return view('tareas/create', [
            'optionsEstado' => Tarea::OPTIONS_ESTADOS,
            'provincias' => Provincia::all(),
            'operarios' => Empleado::getOperarios(),
            'clientes' => Cliente::all()
        ]);
    }
   /**
     * Valida los campos del formulario
     * Guarda la tarea en la bd
     * 
     * @return RedirectResponse
     */
    public function store(StoreTareaRequest $request): RedirectResponse
    {
        $request->validated();
        $tarea = Tarea::create($request->all());

        return redirect()->route('tareas.show', $tarea);

    }
    /**
     * Muestra la vista con el formulario para editar la tarea,
     * con la lista de provincias, operarios y clientes para rellenar los selects.
     * También devuelve la lista de posibles estados de la tarea.
     * 
     * @return mixed
     */
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
    /**
     * Valida los campos del formulario
     * Actualiza la tarea en la bd
     * 
     * @return RedirectResponse
     */
    public function update(StoreTareaRequest $request, Tarea $tarea): RedirectResponse
    {
        $request->validated();
        $tarea->update($request->all());

        return redirect()->route('tareas.show', $tarea);
    }
    /**
     * Muestra la vista con el formulario para completar la tarea.
     * También devuelve la lista de posibles estados de la tarea.
     * 
     * @return mixed
     */
    public function completar(Tarea $tarea)
    {
        return view('tareas/completar', [
            'tarea' => $tarea,
            'optionsEstado' => Tarea::OPTIONS_ESTADOS
        ]);
    }
    /**
     * Valida los campos del formulario
     * Guarda los ficheros y imagenes en storage.
     * Actualiza la tarea en la bd
     * 
     * @return RedirectResponse
     */
    public function completarUpdate(CompletarTareaRequest $request, Tarea $tarea): RedirectResponse
    {
        $request->validated();

        $tarea->guardarFichero($request);
        $tarea->guardarImagenes($request);

        $tarea->update($request->all());
        
        return redirect()->route('tareas.show', $tarea);
    }
     /**
     * Muestra la vista de confirmación para eliminar la tarea
     * 
     * @return mixed
     */
    public function delete(Tarea $tarea)
    {
        return view('tareas/confirmacion', compact('tarea'));
    }
     /**
     * Elimina la tarea.
     * Redirige al usuario a otra vista con los resultados de la operación de eliminar.
     * 
     * @return RedirectResponse
     */
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
