<?php
/**
 * Autor: Valentin Andrei Culea
 * Fecha: 07/12/2023
 * Versión 1
 */
?>
@extends('layouts.plantilla')

@section('titulo', 'Confirmar la eliminación')

@section('contenido')
    
    <h1>¿Estás seguro que quieres eliminar el empleado/a '{{ $empleado->nombre }}'?</h1>

    <p>Se eliminará el empleado permanentemente, no habrá forma de recuperarlo más tarde.</p>

    <div class="botones d-flex gap-1">
        <form action="{{ route('empleados.destroy', $empleado->id) }}" method="POST">
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