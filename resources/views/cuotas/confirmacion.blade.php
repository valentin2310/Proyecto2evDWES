<?php
/**
 * @author: Valentin Andrei Culea
 * @date: 30/01/2024
 * @version 2
 */
?>
@extends('layouts.plantilla')

@section('titulo', 'Confirmar la eliminación')

@section('contenido')
    
    <h1>¿Estás seguro que quieres eliminar la cuota {{ $cuota->id }}: '{{ $cuota->concepto }}'?</h1>

    <p>Se eliminará la cuota permanentemente, no habrá forma de recuperarla más tarde.</p>

    <div class="botones d-flex gap-1">
        <form action="{{ route('cuotas.destroy', $cuota->id) }}" method="POST">
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