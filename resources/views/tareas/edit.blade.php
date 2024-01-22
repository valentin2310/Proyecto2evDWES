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
                <div class="col-md-5 mb-3">
                    <label class="form-label">Cliente:</label>
                    <select class="form-select" name="id_cliente">
                        @foreach ($listaClientes as $item)
                        <option value="{{ $item->id }}" @selected($item->id == old('id_cliente', $tarea->id_cliente))>
                            {{ $item->nombre }}
                        </option>
                        @endforeach
                    </select>
                    @error('id_cliente')
                        <small class='text-danger float-end'><i class='fa-solid fa-circle-exclamation'></i> {{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-7 mb-3">
                    <label class="form-label">Fecha realización:</label>
                    <input type="text" name="fecha_realizacion" class="form-control"
                        value="{{ old('fecha_realizacion', $tarea->fecha_realizacion) }}"
                    >
                    @error('fecha_realizacion')
                        <small class='text-danger float-end'><i class='fa-solid fa-circle-exclamation'></i> {{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-5 mb-3">
                    <label class="form-label">Operario:</label>
                    <select class="form-select" name="id_operario">
                        @foreach ($listaOperarios as $item)
                        <option value="{{ $item->id }}" @selected($item->id == old('id_operario', $tarea->id_operario))>
                            {{ $item->nombre }}
                        </option>
                        @endforeach
                    </select>
                    @error('id_operario')
                        <small class='text-danger float-end'><i class='fa-solid fa-circle-exclamation'></i> {{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-7 mb-3">
                    <label class="form-label">NIF facturador</label>
                    <input type="text" name="nif" class="form-control"
                        value="{{ old('nif', $tarea->nif) }}"
                    >
                    @error('nif')
                        <small class='text-danger float-end'><i class='fa-solid fa-circle-exclamation'></i> {{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label">Descripción</label>
                    <textarea class="form-control" name="descripcion" cols="30" rows="5" placeholder="Una descripcion sobre la tarea...">{{ old('descripcion', $tarea->descripcion) }}</textarea>
                    @error('descripcion')
                        <small class='text-danger float-end'><i class='fa-solid fa-circle-exclamation'></i> {{ $message }}</small>
                    @enderror
                </div>
            </div>
        </fieldset>
    
        <fieldset>
            <legend class="text-azul">Datos contacto</legend>
            <div class="row m-0 p-2">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Persona de contacto:</label>
                    <input type="text" name="contacto" class="form-control"
                       value="{{ old('contacto', $tarea->contacto) }}"
                    >
                    @error('contacto')
                        <small class='text-danger float-end'><i class='fa-solid fa-circle-exclamation'></i> {{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Teléfono de contacto:</label>
                    <input type="text" name="telefono" class="form-control"
                        value="{{ old('telefono', $tarea->telefono) }}"
                    >
                    @error('telefono')
                        <small class='text-danger float-end'><i class='fa-solid fa-circle-exclamation'></i> {{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label">Correo de contacto:</label>
                    <input type="text" name="correo" class="form-control"
                        value="{{ old('correo', $tarea->correo) }}"
                    >
                    @error('correo')
                        <small class='text-danger float-end'><i class='fa-solid fa-circle-exclamation'></i> {{ $message }}</small>
                    @enderror
                </div>
            </div>
        </fieldset>
    
        <fieldset>
            <legend class="text-azul">Datos de ubicación</legend>
            <div class="row m-0 p-2">
                <div class="col-md-12 mb-3">
                    <label class="form-label">Dirección:</label>
                    <input type="text" name="direccion" class="form-control" 
                        value="{{ old('direccion', $tarea->direccion) }}"
                    >
                    @error('direccion')
                        <small class='text-danger float-end'><i class='fa-solid fa-circle-exclamation'></i> {{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Provincia:</label>
                    <select name="id_provincia" class="form-select">
                        @foreach ($listaProvincias as $item)
                            <option 
                                @selected($item->id == old('id_provincia', $tarea->id_provincia))
                                value="{{ $item->id }}">{{ $item->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Población:</label>
                    <input type="text" name="poblacion" id="poblacion" class="form-control"
                        value="{{ old('poblacion', $tarea->poblacion) }}"
                    >
                    @error('poblacion')
                        <small class='text-danger float-end'><i class='fa-solid fa-circle-exclamation'></i> {{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label">Código postal:</label>
                    <input type="text" name="cod_postal" class="form-control"
                        value="{{ old('cod_postal', $tarea->cod_postal) }}"
                    >
                    @error('cod_postal')
                        <small class='text-danger float-end'><i class='fa-solid fa-circle-exclamation'></i> {{ $message }}</small>
                    @enderror
                </div>
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
    
        {{-- <fieldset>
            <legend>Fichero resumen</legend>
            <label class="form-label">Fichero:</label>
            <input type="file" name="fichero" disabled class="form-control">
        </fieldset>
    
        <fieldset>
            <legend>Fotos del trabajo realizado</legend>
            <label class="form-label">Subir foto:</label>
            <input type="file" name="foto" disabled class="form-control">
        </fieldset> --}}
        
        <div class="text-center">
            <button type="submit" class="btn btn-primary my-3"><i class="fa-solid fa-floppy-disk me-2"></i>Actualizar tarea</button>
        </div>
    </form>
</div>

    
@endsection