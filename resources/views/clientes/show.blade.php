<?php
/**
 * Autor: Valentin Andrei Culea
 * Fecha: 07/12/2023
 * Versión 1
 */
?>
@extends('layouts/plantilla')

@section('titulo', 'Lista de clientes')

@section('contenido')
    <h1>Aquí se muestran todas los clientes</h1>

    <div class="info-busqueda pt-3">
        <p class="fw-bold">Hay {{ $clientes->count() }} resultados:</p>
    </div>

    <div class="table-responsive">
        <table class="tabla-tareas table table-striped table-hover table-bordered text-center">
            <thead class="table-dark text-azul">
                <th>ID</th>
                <th>CIF</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Pais</th>
                <th>Cuota</th>
                <th>Acciones</th>
            </thead>
            <tbody>
                @foreach ($clientes as $item)
                    <tr>
                        <td>#{{ $item->id }}</td>
                        <td>{{ $item->cif }}</td>
                        <td>{{ $item->nombre }}</td>
                        <td>{{ $item->correo }}</td>
                        <td>{{ $item->pais->name }}</td>
                        <td>{{ $item->cuota_mensual }} {{ $item->moneda->symbol }}</td>
                        <td class="text-center">
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
                            <button class="btn btn-dark" title="Modificar el usuario">
                                <a href="{{ route('usuarios.edit', $item->id) }}" class="text-decoration-none text-warning">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                            </button>
                            <button class="btn btn-dark" title="Eliminar el usuario">
                                <a href="{{ route('usuarios.confirmacion', $item->id) }}" class="text-decoration-none text-danger">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
                            </button> --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $clientes->links() }}
@endsection