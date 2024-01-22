<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InfoController extends Controller
{
    public function __invoke($title, $body){
        return view('info/resultado', [
            'title' => $title,
            'body' => $body
        ]);
    }
}
