<?php
/**
 * @author: Valentin Andrei Culea
 * @date: 05/01/2024
 * @version 2
 */
?>
@extends('layouts.plantilla')

@section('titulo', 'Inicio')

@section('contenido')
    <h1 class="mb-5">Página de inicio</h1>

    <div class="inicio-opciones">
        <p class="py-0 px-4 fs-5">Selecciona una opción: </p>
        <ul>
            <li class="bg-secondary"><a href="{{route('home')}}"><i class="fa-solid fa-house text-dark p-2"></i><br>Inicio</a></li>
            @auth
                <li class="bg-dark"><a href="{{route('tareas.index')}}"><i class="fa-solid fa-list-check text-white p-2"></i><br>Ver lista tareas</a></li>
                @if (Auth::user()->esAdmin())
                    <li class="bg-dark"><a href="{{route('tareas.search')}}"><i class="fa-solid fa-magnifying-glass text-white p-2"></i><br>Buscar o filtrar tareas</a></li>
                @endif
            @endauth
            @if (!Auth::user() || Auth::user()->esAdmin())
                <li class="bg-dark"><a href="{{route('tareas.create')}}"><i class="fa-solid fa-square-plus text-white p-2"></i><br>Añadir tarea</a></li>
            @endif
            @auth
                @if (Auth::user()->esAdmin())
                    <li class="bg-dark"><a href="{{route('empleados.show')}}"><i class="fa-solid fa-list-ul text-danger p-2"></i><br>Ver lista empleados</a></li>
                    <li class="bg-dark"><a href="{{route('empleados.create')}}"><i class="fa-solid fa-user-plus text-danger p-2"></i><br>Añadir empleado</a></li>
                    <li class="bg-dark"><a href="{{route('clientes.show')}}"><i class="fa-solid fa-list text-info p-2"></i><br>Ver lista clientes</a></li>
                    <li class="bg-dark"><a href="{{route('clientes.create')}}"><i class="fa-solid fa-user-plus text-info p-2"></i><br>Añadir cliente</a></li>
                    <li class="bg-dark"><a href="{{route('cuotas.show')}}"><i class="fa-solid fa-file-contract text-success p-2"></i><br>Ver lista cuotas</a></li>
                    <li class="bg-dark"><a href="{{route('cuotas.create')}}"><i class="fa-solid fa-file-circle-plus text-success p-2"></i><br>Añadir cuota</a></li>
                @endif
            @endauth
        </ul>
    </div>
@endsection