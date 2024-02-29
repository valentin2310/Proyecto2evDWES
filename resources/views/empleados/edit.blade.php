<?php
/**
 * Autor: Valentin Andrei Culea
 * Fecha: 07/12/2023
 * Versión 1
 */
?>
@extends('layouts/plantilla')

@section('titulo', 'Modificar empleado '.$empleado->id)

@section('contenido')
<div class="d-flex flex-column align-items-center gap-3">

    <h1>Modificar empleado</h1>

    {{$errors}}
    
    <form action="{{ route('empleados.update', $empleado->id) }}" method="POST" class="form bg-dark text-white p-4 rounded">
        @csrf
        @method('put')
    
        <input type="hidden" name="id" value="{{ $empleado->id }}">
        <fieldset>
            <legend class="text-azul">Datos del empleado</legend>
            <div class="row m-0 p-4">
                <div class="col-md-6 mb-3">
                    <label class="form-label"><i class="fa-solid fa-user-tie me-2"></i>Tipo de empleado:</label>
                    <select name="tipo" class="form-select">
                        <option value="1" @selected(old('tipo', $empleado->tipo) == '1')>Operario</option>
                        <option value="0" @selected(old('tipo', $empleado->tipo) == '0')>Administrador</option>
                    </select>
                    @error('tipo')
                        <x-msg_error :message="$message" />
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label"><i class="fa-solid fa-address-card me-2"></i>NIF:</label>
                    <input type="text" name="nif" class="form-control"
                        value="{{ old('nif', $empleado->nif) }}"
                    >
                    @error('nif')
                        <x-msg_error :message="$message" />
                    @enderror
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label"><i class="fa-solid fa-user-tag me-2"></i>Nombre:</label>
                    <input type="text" name="nombre" class="form-control"
                        value="{{ old('nombre', $empleado->nombre) }}"
                    >
                    @error('nombre')
                        <x-msg_error :message="$message" />
                    @enderror
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label"><i class="fa-solid fa-envelope me-2"></i>Correo:</label>
                    <input type="email" name="correo" class="form-control"
                       value="{{ old('correo', $empleado->correo) }}"
                    >
                    @error('correo')
                        <x-msg_error :message="$message" />
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label"><i class="fa-solid fa-key me-2"></i>Contraseña:</label>
                    <input type="password" name="password" class="form-control"
                       value="{{ old('password', $empleado->passwd) }}"
                    >
                    @error('password')
                        <x-msg_error :message="$message" />
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label"><i class="fa-solid fa-key me-2"></i>Repite la contraseña:</label>
                    <input type="password" name="password_2" class="form-control"
                       value="{{ old('password_2', $empleado->passwd) }}"
                    >
                    @error('password_2')
                        <x-msg_error :message="$message" />
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label"><i class="fa-solid fa-phone me-2"></i>Teléfono:</label>
                    <input type="tel" name="telefono" class="form-control"
                       value="{{ old('telefono', $empleado->telefono) }}"
                    >
                    @error('telefono')
                        <x-msg_error :message="$message" />
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label"><i class="fa-solid fa-location-dot me-2"></i>Dirección:</label>
                    <input type="text" name="direccion" class="form-control"
                       value="{{ old('direccion', $empleado->direccion) }}"
                    >
                    @error('direccion')
                        <x-msg_error :message="$message" />
                    @enderror
                </div>
            </div>
        </fieldset>
        <div class="text-center">
            <button type="submit" class="btn btn-primary my-3"><i class="fa-solid fa-floppy-disk me-2"></i>Guardar usuario</button>
        </div>
    
    </form>
</div>
@endsection