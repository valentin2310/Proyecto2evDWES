<?php
/**
 * Autor: Valentin Andrei Culea
 * Fecha: 07/12/2023
 * Versión 1
 */
?>
@extends('layouts.plantilla')

@section('titulo', 'Resultado acción')

@section('contenido')
    
<h1>Eliminar la Tarea {{ $id_tarea }}</h1>

    @if ($resultado)
        <p>Se ha eliminado exitosamente la tarea!!</p>
    @else
        <p>Hubo un error en la eliminación de la tarea</p>
    @endif

    <button class="btn btn-dark fw-bold">
        <a href="{{ route('home') }}" class="text-decoration-none text-white">
            <i class="fa-solid fa-house"></i>
            Volver a inicio
        </a>
    </button>

@endsection