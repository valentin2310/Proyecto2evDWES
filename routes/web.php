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
    Route::get('empleados', 'show')->name('empleados.show');

    Route::get('empleados/create', 'create')->name('empleados.create');
    Route::post('empleados/create', 'store')->name('empleados.store');
    
    Route::get('empleados/{empleado}/edit', 'edit')->name('empleados.edit');
    Route::put('empleados/{empleado}/edit', 'update')->name('empleados.update');
    
    Route::get('empleados/{empleado}/delete', 'delete')->name('empleados.delete');
    Route::delete('empleados/{empleado}/resultado', 'destroy')->name('empleados.destroy');
});

Route::controller(ClienteController::class)->group(function(){
    Route::get('clientes', 'show')->name('clientes.show');

    Route::get('clientes/create', 'create')->name('clientes.create');
    Route::post('clientes/create', 'store')->name('clientes.store');
});

Route::get('info/{title}:{body}', InfoController::class)->name('info');

/* Route::get('factura', function(){

    // Mailtrap.com
    Mail::to('pepito@nosecaen.com')->send(new SendFactura);
    return 'Mensaje enviado';

})->name('mail.factura'); */