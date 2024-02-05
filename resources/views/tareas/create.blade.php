<?php
/**
 * @author: Valentin Andrei Culea
 * @date: 15/01/2024
 * @version 2
 */
?>
@extends('layouts.plantilla')

@section('titulo', 'Crear nueva tarea')

@section('contenido')

<div class="d-flex flex-column align-items-center gap-3">

    <h1>Añadir una tarea</h1>
        
    <form action="{{ route('tareas.store') }}" method="POST" class="form bg-dark text-white p-4 rounded">
        @csrf
    
        <fieldset>
            <legend class="text-azul">Datos de la tarea</legend>
            <div class="row m-0 p-2">
                <x-form_select 
                    name="id_cliente" label="Cliente"
                    :list="$clientes"
                    col="5" show="nombre"
                />
                <x-form_control 
                    name="fecha_realizacion" label="Fecha realización"
                    col="7"
                />
                @auth
                    @if (Auth::user()->esAdmin())
                        <x-form_select 
                            name="id_operario" label="Operario"
                            :list="$operarios"
                            col="5" show="nombre"
                        />
                    @endif
                @endauth
                <x-form_control 
                    name="nif" label="NIF facturador"
                    col="7"
                />
                <div class="col-md-12 mb-3">
                    <label class="form-label">Descripción</label>
                    <textarea class="form-control" name="descripcion" cols="30" rows="5" placeholder="Una descripcion sobre la tarea...">{{ old('descripcion') }}</textarea>
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
                    col="6"
                />
                <x-form_control 
                    name="telefono" label="Telefono"
                    col="6"
                />
                <x-form_control 
                    name="correo" label="Correo de contacto"
                />
            </div>
        </fieldset>
    
        <fieldset>
            <legend class="text-azul">Datos de ubicación</legend>
            <div class="row m-0 p-2">
                <x-form_control 
                    name="direccion" label="Dirección"
                />
                <x-form_select 
                    name="id_provincia" label="Provincia"
                    :list="$provincias"
                    col="6" show="nombre"
                />
                <x-form_control 
                    name="poblacion" label="Poblacion"
                    col="6"
                />
                <x-form_control 
                    name="cod_postal" label="Código postal"
                />
            </div>
        </fieldset>
    
        <fieldset>
            <legend class="text-azul">Anotaciones</legend>
            <div class="row m-0 p-2">
                <div class="col-md-12 mb-3">
                    <label class="form-label">Anotaciones anteriores:</label>
                    <textarea name="anotaciones_anteriores" cols="30" rows="5" class="form-control"></textarea>
                </div>
            </div>
        </fieldset>

        @guest
            <input type="hidden" name="v_user" value="1">
            <fieldset>
                <legend class="text-azul">Verifica tu identidad</legend>
                <div class="row m-0 p-2">
                    <x-form_control 
                        name="v_cif" label="CIF"
                        col="6" placeholder="Introduce tu cif.."
                    />
                    <x-form_control 
                        name="v_telefono" label="Teléfono"
                        col="6" placeholder="Introduce tu número de teléfono.."
                    />
                </div>
            </fieldset>
        @endguest

        
        <div class="text-center">
            <button type="submit" class="btn btn-primary my-3"><i class="fa-solid fa-floppy-disk me-2"></i>Guardar tarea</button>
        </div>
    </form>
</div>
    
@endsection