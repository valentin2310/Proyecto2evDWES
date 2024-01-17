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
                <!-- Campo oculto con el valor del estado -->
                <input type="hidden" name="estado" value="P">
                <div class="col-md-5 mb-3">
                    <label class="form-label">Cliente:</label>
                    <select class="form-select" name="id_cliente">
                        @foreach ($listaClientes as $item)
                        <option value="{{ $item->id }}" @selected($item->id == old('id_cliente'))>
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
                        value="{{ old('fecha_realizacion') }}"
                    >
                    @error('fecha_realizacion')
                        <small class='text-danger float-end'><i class='fa-solid fa-circle-exclamation'></i> {{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-5 mb-3">
                    <label class="form-label">Operario:</label>
                    <select class="form-select" name="id_operario">
                        @foreach ($listaOperarios as $item)
                        <option value="{{ $item->id }}" @selected($item->id == old('id_operario'))>
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
                        value="{{ old('nif') }}"
                    >
                    @error('nif')
                        <small class='text-danger float-end'><i class='fa-solid fa-circle-exclamation'></i> {{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label">Descripción</label>
                    <textarea class="form-control" name="descripcion" cols="30" rows="5" placeholder="Una descripcion sobre la tarea...">{{ old('descripcion') }}</textarea>
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
                       value="{{ old('contacto') }}"
                    >
                    @error('contacto')
                        <small class='text-danger float-end'><i class='fa-solid fa-circle-exclamation'></i> {{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Teléfono de contacto:</label>
                    <input type="text" name="telefono" class="form-control"
                        value="{{ old('telefono') }}"
                    >
                    @error('telefono')
                        <small class='text-danger float-end'><i class='fa-solid fa-circle-exclamation'></i> {{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label">Correo de contacto:</label>
                    <input type="text" name="correo" class="form-control"
                        value="{{ old('correo') }}"
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
                        value="{{ old('direccion') }}"
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
                                @selected($item->id == old('id_provincia'))
                                value="{{ $item->id }}">{{ $item->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Población:</label>
                    <input type="text" name="poblacion" id="poblacion" class="form-control"
                        value="{{ old('poblacion') }}"
                    >
                    @error('poblacion')
                        <small class='text-danger float-end'><i class='fa-solid fa-circle-exclamation'></i> {{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label">Código postal:</label>
                    <input type="text" name="cod_postal" class="form-control"
                        value="{{ old('cod_postal') }}"
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
                    <textarea name="anotaciones_anteriores" cols="30" rows="5" class="form-control"></textarea>
                </div>
                {{-- <div class="col-md-12 mb-3">
                    <label class="form-label">Anotaciones posteriores:</label>
                    <textarea name="anotaciones_posteriores" cols="30" rows="10" class="form-control"></textarea>
                </div> --}}
            </div>
        </fieldset>
    
        {{-- <fieldset>
            <legend>Fichero resumen</legend>
            <label class="form-label">Fichero:</label>
            <input type="file" name="fichero" class="form-control">
        </fieldset>
    
        <fieldset>
            <legend>Fotos del trabajo realizado</legend>
            <label class="form-label">Subir foto:</label>
            <input type="file" name="foto" class="form-control">
        </fieldset> --}}
        
        <div class="text-center">
            <button type="submit" class="btn btn-primary my-3"><i class="fa-solid fa-floppy-disk me-2"></i>Guardar tarea</button>
        </div>
    </form>
</div>
    
@endsection