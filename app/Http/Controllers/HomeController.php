<?php
/**
 * @author Valentin Andrei Culea
 * @version 2
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Muestra la vista home,
     * contiene la lista de acciones que se pueden realizar.
     * 
     * @return mixed
     */
    public function __invoke(){
        return view('home');
    }
}
