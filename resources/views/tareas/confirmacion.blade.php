<?php
/**
 * @author: Valentin Andrei Culea
 * @date: 23/01/2024
 * @version 2
 */
?>
@extends('layouts.plantilla')

@section('titulo', 'Confirmar la eliminación')

@section('contenido')
    
    <h1>¿Estas seguro que quieres eliminar la tarea {{ $tarea->id }}?</h1>

    <section>
        <h2>Datos de la tarea</h2>
        <div class="row m-0">
            <div class="col-md-6">
                <p><span class="fw-bold">Id factura: </span>{{ $tarea->id }}</p>
            </div>
            <div class="col-md-6">
                <p><span class="fw-bold">Estado: </span>{{ $tarea->getEstado() }}</p>
            </div>
            <div class="col-md-12">
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
            <div class="col-md-6">
                <p><span class="fw-bold">Fecha realización: </span>{{ $tarea->fecha_realizacion ?? 'Sin fecha' }}</p>
            </div>
        </div>
    </section>

    <div class="botones d-flex gap-1">
        <form action="{{ route('tareas.destroy', $tarea->id) }}" method="POST">
            @csrf
            @method('delete')
    
            <button type="submit" class="btn btn-danger fw-bold text-white">
                    <i class="fa-solid fa-trash-can"></i>
                    Eliminar
            </button>
        </form>
        <button class="btn btn-secondary fw-bold">
            <a href="{{ route('home') }}" class="text-decoration-none text-white">
                <i class="fa-solid fa-x"></i>
                Cancelar
            </a>
        </button>
    </div>

@endsection