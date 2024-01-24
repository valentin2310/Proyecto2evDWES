<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClienteRequest;
use App\Models\Cliente;
use App\Models\Country;
use App\Models\Moneda;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function show()
    {
        return view('clientes/show', [
            'clientes' => Cliente::paginate(10)
        ]);
    }

    public function create()
    {
        return view('clientes/create', [
            'paises' => Country::all()->sortBy('name'),
            'monedas' => Moneda::all()->sortBy('name')
        ]);
    }

    public function store(StoreClienteRequest $request): RedirectResponse
    {
        $request->validated();
        Cliente::create($request->all());

        return redirect()->route('clientes.show');
    }
}
