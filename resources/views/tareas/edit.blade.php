<?php
/**
 * Autor: Valentin Andrei Culea
 * Fecha: 07/12/2023
 * Versión 1
 */
?>
@extends('layouts.plantilla')

@section('titulo', 'Editar la tarea'. $tarea->id)

@section('contenido')

<div class="d-flex flex-column align-items-center gap-3">

    <form action="{{ route('tareas.update', $tarea) }}" method="POST" class="form bg-dark text-white p-4 rounded">
        @csrf
        @method("put")
    
        <fieldset>
            <legend class="text-azul">Datos de la tarea</legend>
            <div class="row m-0 p-2">
                <x-form_select 
                    name="id_cliente" label="Cliente"
                    :list="$clientes" value="{{ $tarea->id_cliente }}"
                    col="5" show="nombre"
                />
                <x-form_control 
                    name="fecha_realizacion" label="Fecha realización"
                    col="7" value="{{ $tarea->fecha_realizacion }}"
                />
                <x-form_select 
                    name="id_operario" label="Operario"
                    :list="$operarios" value="{{ $tarea->id_operario }}"
                    col="5" show="nombre"
                />
                <x-form_control 
                    name="nif" label="NIF facturador"
                    col="7" value="{{ $tarea->nif }}"
                />
                <div class="col-md-12 mb-3">
                    <label class="form-label">Descripción</label>
                    <textarea class="form-control" name="descripcion" cols="30" rows="5" placeholder="Una descripcion sobre la tarea...">{{ old('descripcion', $tarea->descripcion) }}</textarea>
                    @error('descripcion')
                        <x-msg_error :message="$message" />
                    @enderror
                </div>
            </div>
        </fieldset>
    
        <fieldset>
            <legend class="text-azul">Datos contacto</legend>
            <div class="row m-0 p-2">
                <x-form_control 
                    name="contacto" label="Persona de contacto"
                    col="6" value="{{ $tarea->contacto }}"
                />
                <x-form_control 
                    name="telefono" label="Telefono"
                    col="6" value="{{ $tarea->telefono }}"
                />
                <x-form_control 
                    name="correo" label="Correo de contacto" 
                    value="{{ $tarea->correo }}"
                />
            </div>
        </fieldset>
    
        <fieldset>
            <legend class="text-azul">Datos de ubicación</legend>
            <div class="row m-0 p-2">
                <x-form_control 
                    name="direccion" label="Dirección"
                    value="{{ $tarea->direccion }}"
                />
                <x-form_select 
                    name="id_provincia" label="Provincia"
                    :list="$provincias" value="{{ $tarea->id_provincia }}"
                    col="6" show="nombre"
                />
                <x-form_control 
                    name="poblacion" label="Poblacion"
                    col="6" value="{{ $tarea->poblacion }}"
                />
                <x-form_control 
                    name="cod_postal" label="Código postal" 
                    value="{{ $tarea->cod_postal }}"
                />
            </div>
        </fieldset>
    
        <fieldset>
            <legend class="text-azul">Anotaciones</legend>
            <div class="row m-0 p-2">
                <div class="col-md-12 mb-3">
                    <label class="form-label">Anotaciones anteriores:</label>
                    <textarea name="anotaciones_anteriores" cols="30" rows="5" class="form-control">{{ isset($request) ? $request['anotaciones_anteriores'] : $tarea->anotaciones_a }}</textarea>
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label">Anotaciones posteriores:</label>
                    <textarea name="anotaciones_posteriores" cols="30" disabled rows="5" class="form-control">{{ isset($request) ? $request['anotaciones_posteriores'] : $tarea->anotaciones_p }}</textarea>
                </div>
            </div>
        </fieldset>
        
        <div class="text-center">
            <button type="submit" class="btn btn-primary my-3"><i class="fa-solid fa-floppy-disk me-2"></i>Actualizar tarea</button>
        </div>
    </form>
</div>

    
@endsection