<?php
/**
 * @author Valentin Andrei Culea
 * @version 2
 */

namespace App\Http\Controllers;

use App\Http\Requests\StoreClienteRequest;
use App\Models\Cliente;
use App\Models\Country;
use App\Models\Moneda;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Mostrar todos los clientes paginados
     * 
     * @return mixed
     */
    public function show()
    {
        return view('clientes/show', [
            'clientes' => Cliente::paginate(10)
        ]);
    }
    /**
     * Muestra la vista para crear un cliente, 
     * con la lista de paises y monedas para rellenar los selects
     * 
     * @return mixed
     */
    public function create()
    {
        return view('clientes/create', [
            'paises' => Country::all()->sortBy('name'),
            'monedas' => Moneda::all()->sortBy('name')
        ]);
    }
    /**
     * Valida los campos del formulario
     * Guarda el cliente en la bd
     * 
     * @return RedirectResponse
     */
    public function store(StoreClienteRequest $request): RedirectResponse
    {
        $request->validated();
        Cliente::create($request->all());

        return redirect()->route('clientes.show');
    }
    /**
     * Muestra la vista con el formulario para editar el cliente,
     * con la lista de paises y monedas para rellenar los selects
     * 
     * @return mixed
     */
    public function edit(Cliente $cliente)
    {
        return view('clientes/edit', [
            'cliente' => $cliente,
            'paises' => Country::all()->sortBy('name'),
            'monedas' => Moneda::all()->sortBy('name')
        ]);
    }
    /**
     * Valida los campos del formulario
     * Actualiza el cliente en la bd
     * 
     * @return RedirectResponse
     */
    public function update(StoreClienteRequest $request, Cliente $cliente): RedirectResponse
    {
        $request->validated();
        $cliente->update($request->all());

        return redirect()->route('clientes.show');
    }
    /**
     * Muestra la vista de confirmación para eliminar el cliente
     * 
     * @return mixed
     */
    public function delete(Cliente $cliente)
    {
        return view('clientes/confirmacion', compact('cliente'));
    }
    /**
     * Elimina el cliente
     * Redirige al usuario a otra vista con los resultados de la operación de eliminar.
     * 
     * @return RedirectResponse
     */
    public function destroy(Cliente $cliente)
    {
        $resultado = $cliente->delete();

        return redirect()->route('info', [
            'title' => 'Eliminar el cliente '.$cliente->nombre,
            'body' => $resultado ? 'El cliente se ha eliminado exitosamente.' : 'Hubo un error al eliminar el cliente'
        ]);
    }
}
