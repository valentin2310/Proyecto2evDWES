<?php
/**
 * @author: Valentin Andrei Culea
 * @fecha: 25/01/2024
 * @version 2
 */
?>
@extends('layouts/plantilla')

@section('titulo', 'Lista de empleados')

@section('contenido')
    <h1>Aquí se muestran todos los empleados</h1>

    <button class="btn btn-dark my-3">
        <a href="{{ route('empleados.create') }}" class="text-decoration-none text-white">
            <i class="fa-solid fa-user-plus text-info me-2"></i>Añadir empleado
        </a>
    </button>

    <div class="info-busqueda">
        <p class="fw-bold">Hay {{ $empleados->count() }} resultados:</p>
    </div>

    <div class="table-responsive">
        <table class="tabla-tareas table table-striped table-hover table-bordered text-center">
            <thead class="table-dark text-azul">
                <th>ID</th>
                <th>NIF</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Tipo</th>
                <th>Acciones</th>
            </thead>
            <tbody>
                @foreach ($empleados as $item)
                    <tr>
                        <td>#{{ $item->id }}</td>
                        <td>{{ $item->nif }}</td>
                        <td>{{ $item->nombre }}</td>
                        <td>{{ $item->correo }}</td>
                        <td>{{ $item->esAdmin() ? 'Admin' : 'Operario' }}</td>
                        <td class="text-center">
                            <button class="btn btn-dark" title="Modificar el usuario">
                                <a href="{{ route('empleados.edit', $item->id) }}" class="text-decoration-none text-warning">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                            </button>
                            <button class="btn btn-dark" title="Eliminar el usuario">
                                <a href="{{ route('empleados.delete', $item->id) }}" class="text-decoration-none text-danger">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
                            </button>
                            {{-- <button class="btn btn-dark" title="Ver tareas asignadas del operario">
                                <a href="{{ route('tareas.search', [
                                        'page'=>1,
                                        'campo1'=>'operario',
                                        'criterio1'=>'like',
                                        'valor1'=>$item->id
                                    ]) }}" 
                                    class="text-decoration-none text-white">
                                    <i class="fa-solid fa-list-check"></i>
                                </a>
                            </button>
                             --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $empleados->links() }}
@endsection