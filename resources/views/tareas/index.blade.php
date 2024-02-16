<?php
/**
 * @author: Valentin Andrei Culea
 * @date 31/01/2024
 * @version 2
 */
?>
@extends('layouts.plantilla')

@section('titulo', 'Listado de Tareas')

@section('contenido')
    <h1>Aquí se muestran todas las tareas</h1>

    <div class="info-busqueda pt-3">
        <p class="fw-bold">Hay {{ count($tareas) }} resultados:</p>
    </div>

    <div class="table-responsive">
        <table class="tabla-tareas table table-striped table-hover table-bordered text-center">
            <thead class="table-dark text-azul">
                <th>ID</th>
                <th>NIF facturador</th>
                <th>Estado</th>
                <th>Operario</th>
                <th>Descripcion</th>
                <th>Persona contacto</th>
                <th>Fecha creación</th>
                <th>Fecha realizacón</th>
                <th>Acciones</th>
            </thead>
            <tbody>
                @foreach ($tareas as $item)
                    <tr>
                        <td>#{{ $item->id }}</td>
                        <td>{{ $item->nif }}</td>
                        <td>{{ $item->estado }}</td>
                        @if ($item->operario)
                            <td>{{ $item->operario->nombre}}</td>
                        @else
                            <td><span class="rounded bg-danger text-white p-1 px-2">Sin operario</span></td>
                        @endif
                        <td>{{ $item->descripcion }}</td>
                        <td>{{ $item->contacto }}</td>
                        <td>{{ $item->fecha_creacion->format('d/m/Y') }}</td>
                        <td>{{ $item->fecha_realizacion ?? 'Sin fecha'}}</td>
                        <td class="text-center d-flex flex-wrap justify-content-around gap-1">
                            @if (Auth::user()->esAdmin())
                                <button class="btn btn-dark" title="Modificar la tarea">
                                    <a href="{{ route('tareas.edit', $item->id) }}" class="text-decoration-none text-warning">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>
                                </button>
                                <button class="btn btn-dark" title="Eliminar la tarea">
                                    <a href="{{ route('tareas.delete', $item->id) }}" class="text-decoration-none text-danger">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </a>
                                </button>
                            @else    
                                <button class="btn btn-dark" title="Completar la tarea">
                                    <a href="{{ route('tareas.completar', $item->id) }}" class="text-decoration-none text-success">
                                        <i class="fa-solid fa-circle-check"></i>
                                    </a>
                                </button>
                            @endif
                            <button class="btn btn-dark" title="Ver toda la información de la tarea">
                                <a href="{{ route('tareas.show', $item->id) }}" class="text-decoration-none text-primary">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $tareas->links() }}

@endsection