<?php
/**
 * @author Valentin Andrei Culea
 * @version 2
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InfoController extends Controller
{
    /**
     * Muestra el resultado de las acciones de eliminar
     * 
     * @return mixed
     */
    public function __invoke($title, $body){
        return view('info/resultado', [
            'title' => $title,
            'body' => $body
        ]);
    }
}
