<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use Illuminate\Http\Request;

class TareaController extends Controller
{
    public function index(){
        return view('tareas/index', [
            'tareas' => Tarea::paginate(10)
        ]);
    }

    public function show(Tarea $tarea){
        return view('tareas/show', compact('tarea'));
    }
}
