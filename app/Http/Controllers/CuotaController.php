<?php

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
    public function show()
    {
        return view('cuotas/show', [
            'cuotas' => Cuota::paginate(10)
        ]);
    }

    public function create()
    {
        return view('cuotas/create', [
            'clientes' => Cliente::all(),
            'tareas' => Tarea::all()
        ]);
    }

    public function store(StoreCuotaRequest $request): RedirectResponse
    {
        $request->validated();
        Cuota::create($request->all());

        return redirect()->route('cuotas.show');
    }

    public function edit(Cuota $cuota)
    {
        return view('cuotas/edit', [
            'cuota' => $cuota,
            'clientes' => Cliente::all(),
            'tareas' => Tarea::all()
        ]);
    }
    public function update(StoreCuotaRequest $request, Cuota $cuota): RedirectResponse
    {
        $request->validated();
        $cuota->update($request->all());

        return redirect()->route('cuotas.show');
    }

    public function delete(Cuota $cuota)
    {
        return view('cuotas/confirmacion', compact('cuota'));
    }

    public function destroy(Cuota $cuota)
    {
        $resultado = $cuota->delete();

        return redirect()->route('info', [
            'title' => 'Eliminar la cuota '.$cuota->concepto,
            'body' => $resultado ? 'La cuota se ha eliminado exitosamente.' : 'Hubo un error al eliminar la cuota'
        ]);
    }

    public function remesaMensual(): RedirectResponse
    {
        Cuota::addRemesaMensual();
        return redirect()->route('cuotas.show');
    }

    public function pdf(Cuota $cuota)
    {
        $pdf = Pdf::loadView('cuotas.pdf', compact('cuota'));

        $data["cuota"] = $cuota;
        $data["pdf"] = $pdf;

        Mail::to($cuota->cliente->correo)->send(new SendFactura($data));

        return redirect()->route('cuotas.show');
    }
}
