<?php
/**
 * @author: Valentin Andrei Culea
 * @date: 08/01/2024
 * @version 2
 */
?>
@extends('layouts.plantilla')

@section('titulo', 'Resultado acción')

@section('contenido')
    
<h1>{{ $title }}</h1>

    <p>{{ $body }}</p>

    <button class="btn btn-dark fw-bold">
        <a href="{{ route('home') }}" class="text-decoration-none text-white">
            <i class="fa-solid fa-house"></i>
            Volver a inicio
        </a>
    </button>

@endsection