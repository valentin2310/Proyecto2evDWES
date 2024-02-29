<?php
/**
 * @author: Valentin Andrei Culea
 * @date: 29/02/2024
 * @version 2
 */
?>
@extends('layouts.plantilla')

@section('titulo', 'Listado de Tareas')

@section('contenido')
    <h1>Busca y filtra las tareas</h1>

    <form action="{{ route('tareas.search') }}" method="GET" class="busqueda my-4">
        @csrf
        
        <div class="row m-0 mb-1 align-items-center fw-bold">
            <div class="col-2">
                <i class="fa-solid fa-filter me-2"></i>Campo
            </div>
            <div class="col-2">
                Criterio
            </div>
            <div class="col-6">
                <i class="fa-solid fa-keyboard me-2"></i>Valor
            </div>
            <div class="col-2">
                <button type="submit" class="btn btn-dark text-azul fw-bold w-100 text-start"><i class="fa-solid fa-magnifying-glass me-4"></i>Buscar</button>
            </div>
        </div>
        <div class="row m-0 mb-1">
            <div class="col-2">
                <select name="campo1" id="camp1o" class="form-select">
                   @foreach ($OPTIONS_CAMPOS as $key => $value)
                        <option value="{{ $key }}"
                            @if (!empty($filtros["campo1"]))
                                {{ ($filtros["campo1"] == $key ? "selected":"") }}
                            @endif
                        >
                            {{ $value }}
                        </option>
                   @endforeach
                </select>
            </div>
            <div class="col-2">
                <select name="criterio1" id="criterio1" class="form-select">
                    @foreach ($OPTIONS_CRITERIOS as $key => $value)
                        <option value="{{ $key }}" 
                            @if (!empty($filtros["criterio1"]))
                                {{ ($filtros["criterio1"] == $key ? "selected":"") }}
                            @endif    
                        >
                            {{ $value }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-8">
                <input type="text" name="valor1" id="valor1" class="form-control" value="{{ $filtros["valor1"]  ?? '' }}">
            </div>
        </div>
        
    </form>

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
                            @elseif($item->estado != 'R')
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