<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function show()
    {
        return view('clientes/show', [
            'clientes' => Cliente::paginate(10)
        ]);
    }
}
