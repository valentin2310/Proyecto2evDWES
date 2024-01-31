<?php
/**
 * @author: Valentin Andrei Culea
 * @date: 01/01/2024
 * @version 2
 */
?>
@extends('layouts/plantilla')

@section('titulo', 'Nuevo empleado')

@section('contenido')

<div class="d-flex flex-column align-items-center gap-3">

    <h1>Añadir empleado</h1>
    
    <form action="{{ route('empleados.store') }}" method="POST" class="form bg-dark text-white p-4 rounded">
        @csrf

        <fieldset>
            <legend class="text-azul">Datos del empleado</legend>
            <div class="row m-0 p-4">
                <div class="col-md-6 mb-3">
                    <label class="form-label"><i class="fa-solid fa-user-tie me-2"></i>Tipo de empleado:</label>
                    <select name="tipo" class="form-select">
                        <option value="1" @selected(old('tipo') == '1')>Operario</option>
                        <option value="0" @selected(old('tipo') == '0')>Administrador</option>
                    </select>
                    @error('tipo')
                        <x-msg_error :message="$message" />
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label"><i class="fa-solid fa-address-card me-2"></i>NIF:</label>
                    <input type="text" name="nif" class="form-control"
                        value="{{ old('nif') }}"
                    >
                    @error('nif')
                        <x-msg_error :message="$message" />
                    @enderror
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label"><i class="fa-solid fa-user-tag me-2"></i>Nombre:</label>
                    <input type="text" name="nombre" class="form-control"
                        value="{{ old('nombre') }}"
                    >
                    @error('nombre')
                        <x-msg_error :message="$message" />
                    @enderror
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label"><i class="fa-solid fa-envelope me-2"></i>Correo:</label>
                    <input type="email" name="correo" class="form-control"
                       value="{{ old('correo') }}"
                    >
                    @error('correo')
                        <x-msg_error :message="$message" />
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label"><i class="fa-solid fa-key me-2"></i>Contraseña:</label>
                    <input type="password" name="password" class="form-control"
                       value="{{ old('password') }}"
                    >
                    @error('password')
                        <x-msg_error :message="$message" />
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label"><i class="fa-solid fa-key me-2"></i>Repite la contraseña:</label>
                    <input type="password" name="password_2" class="form-control"
                       value="{{ old('password_2') }}"
                    >
                    @error('password_2')
                        <x-msg_error :message="$message" />
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label"><i class="fa-solid fa-phone me-2"></i>Teléfono:</label>
                    <input type="tel" name="telefono" class="form-control"
                       value="{{ old('telefono') }}"
                    >
                    @error('telefono')
                        <x-msg_error :message="$message" />
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label"><i class="fa-solid fa-location-dot me-2"></i>Dirección:</label>
                    <input type="text" name="direccion" class="form-control"
                       value="{{ old('direccion') }}"
                    >
                    @error('direccion')
                        <x-msg_error :message="$message" />
                    @enderror
                </div>
            </div>
        </fieldset>
        <div class="text-center">
            <button type="submit" class="btn btn-primary my-3"><i class="fa-solid fa-floppy-disk me-2"></i>Guardar empleado</button>
        </div>
    
    </form>
</div>

@endsection