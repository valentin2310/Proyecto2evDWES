<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\TareaController;
use App\Mail\SendFactura;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', HomeController::class)->name('home');

Route::controller(TareaController::class)->group(function () {
    Route::get('tareas', 'index')->name('tareas.index');

    Route::get('tareas/create', 'create')->name('tareas.create');
    Route::post('tareas/create', 'store')->name('tareas.store');
    
    /* 
    Route::get('tareas/search', 'search')->name('tareas.search');
    */

    Route::get('tareas/{tarea}', 'show')->name('tareas.show');
    
    Route::get('tareas/{tarea}/completar', 'completar')->name('tareas.completar');
    Route::put('tareas/{tarea}/completar', 'completarUpdate')->name('tareas.completarUpdate');
    
    Route::get('tareas/{tarea}/edit', 'edit')->name('tareas.edit');
    Route::put('tareas/{tarea}', 'update')->name('tareas.update');

    Route::get('tareas/{tarea}/delete', 'delete')->name('tareas.delete');
    Route::delete('tareas/{tarea}/resultado', 'destroy')->name('tareas.destroy');
});

Route::controller(EmpleadoController::class)->group(function(){
    /* Route::get('login', 'index')->name('login.index');
    Route::post('login', 'login')->name('login.login');
    Route::post('logout', 'logout')->name('login.logout'); */

    Route::get('empleados', 'show')->name('empleados.show');

    /* Route::get('usuarios/create', 'create')->name('usuarios.create');
    Route::post('usuarios/create', 'store')->name('usuarios.store');

    Route::get('usuarios/{usuario}/edit', 'edit')->name('usuarios.edit');
    Route::put('usuarios/{usuario}/edit', 'update')->name('usuarios.update');

    Route::get('usuarios/{usuario}/delete', 'confirmacion')->name('usuarios.confirmacion');
    Route::get('usuarios/{usuario}/resultado', 'delete')->name('usuarios.delete'); */
});

Route::controller(ClienteController::class)->group(function(){
    Route::get('clientes', 'show')->name('clientes.show');
});

Route::get('info/{title}:{body}', InfoController::class)->name('info');

/* Route::get('factura', function(){

    // Mailtrap.com
    Mail::to('pepito@nosecaen.com')->send(new SendFactura);
    return 'Mensaje enviado';

})->name('mail.factura'); */