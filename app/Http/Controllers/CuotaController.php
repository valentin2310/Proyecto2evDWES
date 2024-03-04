<?php
/**
 * @author Valentin Andrei Culea
 * @version 2
 */

namespace App\Http\Controllers;

use App\Http\Requests\StoreCuotaRequest;
use App\Mail\SendFactura;
use App\Models\Cliente;
use App\Models\Cuota;
use App\Models\Tarea;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;

class CuotaController extends Controller
{
    /**
     * Mostrar todos las cuotas paginadas
     * 
     * @return mixed
     */
    public function show()
    {
        return view('cuotas/show', [
            'cuotas' => Cuota::paginate(10)
        ]);
    }
    /**
     * Muestra la vista para crear una cuota, 
     * con la lista de clientes y tareas para rellenar los selects
     * 
     * @return mixed
     */
    public function create()
    {
        return view('cuotas/create', [
            'clientes' => Cliente::all(),
            'tareas' => Tarea::all()
        ]);
    }
    /**
     * Valida los campos del formulario
     * Guarda la cuota en la bd
     * 
     * @return RedirectResponse
     */
    public function store(StoreCuotaRequest $request): RedirectResponse
    {
        $request->validated();
        Cuota::create($request->all());

        return redirect()->route('cuotas.show');
    }
     /**
     * Muestra la vista con el formulario para editar la cuota,
     * con la lista de clientes y tareas para rellenar los selects
     * 
     * @return mixed
     */
    public function edit(Cuota $cuota)
    {
        return view('cuotas/edit', [
            'cuota' => $cuota,
            'clientes' => Cliente::all(),
            'tareas' => Tarea::all()
        ]);
    }
    /**
     * Valida los campos del formulario
     * Actualiza la cuota en la bd
     * 
     * @return RedirectResponse
     */
    public function update(StoreCuotaRequest $request, Cuota $cuota): RedirectResponse
    {
        $request->validated();
        $cuota->update($request->all());

        return redirect()->route('cuotas.show');
    }
     /**
     * Muestra la vista de confirmación para eliminar la cuota
     * 
     * @return mixed
     */
    public function delete(Cuota $cuota)
    {
        return view('cuotas/confirmacion', compact('cuota'));
    }
     /**
     * Elimina la cuota
     * Redirige al usuario a otra vista con los resultados de la operación de eliminar.
     * 
     * @return RedirectResponse
     */
    public function destroy(Cuota $cuota)
    {
        $resultado = $cuota->delete();

        return redirect()->route('info', [
            'title' => 'Eliminar la cuota '.$cuota->concepto,
            'body' => $resultado ? 'La cuota se ha eliminado exitosamente.' : 'Hubo un error al eliminar la cuota'
        ]);
    }
    /**
     * Crea una remesa mensual para cada cliente
     * Llama al modelo cuota para añadir las cuotas para cada cliente.
     * 
     * @return RedirectResponse
     */
    public function remesaMensual(): RedirectResponse
    {
        Cuota::addRemesaMensual();
        return redirect()->route('cuotas.show');
    }
    /**
     * Crea un pdf con la vista de la cuota
     * Le pasa como data la información de la cuota y el pdf
     * Manda el correo a la dirección de correo del cliente que tiene la cuota
     * Por último, redirige al usuairo a la página con todas las cuotas. 
     * 
     * @return RedirectResponse
     */
    public function correo(Cuota $cuota)
    {
        $pdf = Pdf::loadView('cuotas.pdf', compact('cuota'));

        $data["cuota"] = $cuota;
        $data["pdf"] = $pdf;

        Mail::to($cuota->cliente->correo)->send(new SendFactura($data));

        return redirect()->route('cuotas.show');
    }
    /**
    * Genera el pdf cargando la vista de la cuota con sus datos
    * Devuelve el stream del pdf para visualizarlo.
    *
    * @return mixed
    */
    public function pdf(Cuota $cuota)
    {
        $pdf = Pdf::loadView('cuotas.pdf', compact('cuota'));
        return $pdf->stream();
    }
}
