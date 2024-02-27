<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CuotaController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\TareaController;
use App\Mail\SendFactura;
use App\Models\Cuota;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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

Route::controller(LoginController::class)->group(function() {
    Route::get('login', 'index')->name('login');
    Route::post('login', 'authenticate')->name('login.auth');

    Route::post('logout', 'logout')->name('logout');
});

Route::get('/login/google/redirect', function(){
    return Socialite::driver('google')->redirect();
})->name('login.google');

Route::get('/login/google/callback', function(){
    $user = Socialite::driver('google')->user();

    dd($user);
});

Route::controller(TareaController::class)->group(function () {
    Route::get('tareas', 'index')->name('tareas.index')->middleware('auth');

    Route::get('tareas/create', 'create')->name('tareas.create');
    Route::post('tareas/create', 'store')->name('tareas.store');
    
    /* 
    Route::get('tareas/search', 'search')->name('tareas.search');
    */

    Route::get('tareas/{tarea}', 'show')->name('tareas.show')->middleware('auth');
    
    Route::get('tareas/{tarea}/completar', 'completar')->name('tareas.completar')->middleware('auth');
    Route::put('tareas/{tarea}/completar', 'completarUpdate')->name('tareas.completarUpdate')->middleware('auth');
    
    Route::get('tareas/{tarea}/edit', 'edit')->name('tareas.edit')->middleware('auth, isAdmin');
    Route::put('tareas/{tarea}', 'update')->name('tareas.update')->middleware('auth, isAdmin');

    Route::get('tareas/{tarea}/delete', 'delete')->name('tareas.delete')->middleware('auth, isAdmin');
    Route::delete('tareas/{tarea}/delete', 'destroy')->name('tareas.destroy')->middleware('auth, isAdmin');
});

Route::controller(EmpleadoController::class)->group(function(){
    Route::get('empleados', 'show')->name('empleados.show');

    Route::get('empleados/create', 'create')->name('empleados.create');
    Route::post('empleados/create', 'store')->name('empleados.store');
    
    Route::get('empleados/{empleado}/edit', 'edit')->name('empleados.edit');
    Route::put('empleados/{empleado}/edit', 'update')->name('empleados.update');
    
    Route::get('empleados/{empleado}/delete', 'delete')->name('empleados.delete');
    Route::delete('empleados/{empleado}/delete', 'destroy')->name('empleados.destroy');

})->middleware('auth, isAdmin');

Route::controller(ClienteController::class)->group(function(){
    Route::get('clientes', 'show')->name('clientes.show');

    Route::get('clientes/create', 'create')->name('clientes.create');
    Route::post('clientes/create', 'store')->name('clientes.store');

    Route::get('clientes/{cliente}/edit', 'edit')->name('clientes.edit');
    Route::put('clientes/{cliente}/edit', 'update')->name('clientes.update');

    Route::get('clientes/{cliente}/delete', 'delete')->name('clientes.delete');
    Route::delete('clientes/{cliente}/delete', 'destroy')->name('clientes.destroy');

})->middleware('auth, isAdmin');

Route::controller(CuotaController::class)->group(function(){
    Route::get('cuotas', 'show')->name('cuotas.show');

    Route::get('cuotas/create', 'create')->name('cuotas.create');
    Route::post('cuotas/create', 'store')->name('cuotas.store');

    Route::post('cuotas/remesa', 'remesaMensual')->name('cuotas.remesa');

    Route::get('cuotas/{cuota}/pdf', 'pdf')->name('cuotas.pdf');

    Route::get('cuotas/{cuota}/edit', 'edit')->name('cuotas.edit');
    Route::put('cuotas/{cuota}/edit', 'update')->name('cuotas.update');

    Route::get('cuotas/{cuota}/delete', 'delete')->name('cuotas.delete');
    Route::delete('cuotas/{cuota}/delete', 'destroy')->name('cuotas.destroy');

})->middleware('auth, isAdmin');

Route::get('info/{title}:{body}', InfoController::class)->name('info');

Route::get('/paypal/{cuota}/pay', [PaypalController::class, 'pay'])->name('paypal.pay');
Route::get('/paypal/{cuota}/status', [PaypalController::class, 'status'])->name('paypal.status');
Route::get('/paypal/result', [PaypalController::class, 'result'])->name('paypal.result');