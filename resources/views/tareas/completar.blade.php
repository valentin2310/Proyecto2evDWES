<?php
/**
 * Autor: Valentin Andrei Culea
 * Fecha: 07/12/2023
 * Versión 1
 */
?>
@extends('layouts.plantilla')

@section('titulo', 'Completar la tarea '.$tarea->id)

@section('contenido')

<div class="d-flex flex-column align-items-center gap-3">

    <h1>Completar la tarea {{ $tarea->id }}</h1>
    
    <section class="mx-5">
        <h2 class="text-azul">Datos de la tarea</h2>
        <div class="row m-0">
            <div class="col-md-6">
                <p><span class="fw-bold">Id factura: </span>{{ $tarea->id }}</p>
            </div>
            <div class="col-md-6">
                <p><span class="fw-bold">Estado: </span>{{ $tarea->getEstado() }}</p>
            </div>
            <div class="col-md-6">
                <p><span class="fw-bold">Cliente: </span>{{ $tarea->cliente->nombre ?? $tarea->contacto }}</p>
            </div>
            <div class="col-md-6">
                <p><span class="fw-bold">NIF facturador: </span>{{ $tarea->nif }}</p>
            </div>
            <div class="col-md-12">
                <p><span class="fw-bold">Operario: </span>{{ $tarea->operario->nombre ?? 'Ninguno' }}</p>
            </div>
            <div class="col-md-12">
                <p><span class="fw-bold">Descripción: </span>{{ $tarea->descripcion }}</p>
            </div>
            <div class="col-md-6">
                <p><span class="fw-bold">Fecha creación: </span>{{ $tarea->fecha_creacion->format('d/m/Y') }}</p>
            </div>
        </div>
    </section>
    
    <form action="{{ route('tareas.completarUpdate', $tarea->id) }}" method="POST" enctype="multipart/form-data" class="form bg-dark text-white p-4 rounded">
        @csrf
        @method("put")

        <fieldset>
            <legend class="text-azul">Modificar datos</legend>
            <div class="row m-0 p-2">
                <label class="form-label">Estado:</label>
                <div class="col-md-12 mb-3">
                    @foreach ($optionsEstado as $key => $value)
                        <div class="form-chek">
                            <input type="radio" name="estado" value="{{ $key }}" class="form-check-input"
                                @if ($key == 'R') 
                                    checked 
                                @endif
                            >
                            <label class="form-check-label">{{ $value }}</label>
                        </div>
                    @endforeach
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label">Fecha realización:</label>
                    <input type="text" name="fecha_realizacion" class="form-control"
                        value="{{ old('fecha_realizacion', $tarea->fecha_realizacion) }}"
                    >
                    @error('fecha_realizacion')
                        <small class='text-danger float-end'><i class='fa-solid fa-circle-exclamation'></i> {{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label">Anotaciones posteriores:</label>
                    <textarea name="anotaciones_posteriores" cols="30" rows="10" class="form-control">{{ old('anotaciones_posteriores', $tarea->anotaciones_posteriores) }}</textarea>
                </div>
            </div>
            <fieldset class="mb-3">
                <legend class="text-azul">Fichero resumen</legend>
                <div class="row m-0 p-2">
                    <label class="form-label">Fichero:</label>
                    <input type="file" name="fichero" accept=".pdf, .doc, .docx, .txt" class="form-control"
                        value="{{ old('fichero', $tarea->fichero) }}"
                    >
                </div>
            </fieldset>
        
            <fieldset>
                <legend class="text-azul">Fotos del trabajo realizado</legend>
                <div class="row m-0 p-2">
                    <label class="form-label">Subir foto:</label>
                    <input type="file" name="fotos[]" accept="image/*" multiple class="form-control"
                        value="{{ old('fotos[]', $tarea->fotos) }}"
                    >
                </div>
            </fieldset>
        </fieldset>
        <div class="text-center">
            <button type="submit" class="btn btn-primary text-white fw-bold my-3">
                <i class="fa-solid fa-floppy-disk me-2"></i>
                Guardar cambios
            </button>
        </div>
    </form>
</div>


@endsection