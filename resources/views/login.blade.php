<?php
/**
 * @author: Valentin Andrei Culea
 * @date: 30/01/2024
 * @version 2
 */
?>
@extends('layouts.simple')

@section('titulo', 'Login')

@section('contenido')
    
    <div class="login d-flex justify-content-center align-items-center flex-direction-column">
        <div class="login-container bg-dark text-white p-5 rounded">
            <div class="login-icon text-center">
                <i class="fa-solid fa-circle-user my-3"></i>
            </div>
            <h2 class="login-titulo mb-5 text-center">Iniciar sesión</h2>
            <form action="{{ route('login.auth') }}" method="POST" class="login-cuerpo">
                @csrf

                <div class="other-auth mb-5">
                    <a class="btn btn-primary" href="{{ route('login.google') }}">
                        Google
                    </a>
                </div>

                <div class="row m-0">
                    <x-form_control 
                        name="correo" label="Email"
                        icon="fa-solid fa-envelope"
                    />
                    <x-form_control 
                        name="password" label="Contraseña" 
                        type="password" icon="fa-solid fa-key"
                    />
                </div>
               
                <div class="form-check mt-5 mb-2">
                    <input type="checkbox" name="recordar" class="form-check-input">
                    <label class="form-check-label">Recordar credenciales de inicio de sesión
                        <i class="fa-solid fa-circle-question ms-2" 
                        title="Tus credenciales se guardarán para evitar tener que iniciar sesión siempre, después de 3 días tendrás que volver a introducir tus credenciales"></i>
                    </label>
                </div>
                <div class="text-center pt-3">
                    <button type="submit" class="btn btn-primary fw-bold">Iniciar Sesión</button>
                </div>
            </form>
        </div>
    </div>

@endsection