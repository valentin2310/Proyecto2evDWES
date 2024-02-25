<?php
/**
 * @author: Valentin Andrei Culea
 * @date: 27/01/2024
 * @version 2
 */
?>
@extends('layouts/plantilla')

@section('titulo', 'Lista de cuotas')

@section('contenido')
    <h1>Aquí se muestran todas las cuotas</h1>

    <div class="botones d-flex gap-1">
        <button class="btn btn-dark my-3">
            <a href="{{ route('cuotas.create') }}" class="text-decoration-none text-white">
                <i class="fa-solid fa-user-plus text-info me-2"></i>Añadir cuota
            </a>
        </button>
    
        <form action="{{ route('cuotas.remesa') }}" method="POST">
            @csrf
    
            <button class="btn btn-dark text-white my-3">
                <i class="fa-solid fa-file-invoice-dollar text-info me-2"></i>
                Remesa mensual
            </button>
        </form>
    </div>

    <div class="info-busqueda">
        <p class="fw-bold">Hay {{ $cuotas->count() }} resultados:</p>
    </div>

    <div class="table-responsive">
        <table class="tabla-tareas table table-striped table-hover table-bordered text-center">
            <thead class="table-dark text-azul">
                <th>ID</th>
                <th>Cliente</th>
                <th>Concepto</th>
                <th>Importe(€)</th>
                <th>Tarea</th>
                <th>Fecha emision</th>
                <th>Pagada</th>
                <th>Fecha pago</th>
                <th>Notas</th>
                <th>Acciones</th>
            </thead>
            <tbody>
                @foreach ($cuotas as $item)
                    <tr>
                        <td>#{{ $item->id }}</td>
                        <td>{{ $item->cliente->nombre }}</td>
                        <td>{{ $item->concepto }}</td>
                        <td>{{ $item->importe }} {{ $item->cliente->moneda->symbol }}</td>
                        <td>{{ $item->tarea ? 'Si' : 'No' }}</td>
                        <td>{{ $item->fecha_emision->format('d/m/Y') }}</td>
                        <td>{{ $item->pagada ? 'Si' : 'No' }}</td>
                        <td>{{ $item->fecha_pago }}</td>
                        <td>{{ $item->notas }}</td>
                        <td class="text-center">
                            <button class="btn btn-dark" title="Corregir cuota">
                                <a href="{{ route('cuotas.pdf', $item->id) }}" class="text-decoration-none text-info">
                                    <i class="fa-solid fa-file-pdf"></i>
                                </a>
                            </button>
                            {{-- <button class="btn btn-dark" title="Corregir cuota">
                                <a href="{{ route('mail.factura', $item->id) }}" class="text-decoration-none text-info">
                                    <i class="fa-solid fa-file-pdf"></i>
                                </a>
                            </button> --}}
                            <button class="btn btn-dark" title="Corregir cuota">
                                <a href="{{ route('cuotas.edit', $item->id) }}" class="text-decoration-none text-warning">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                            </button>
                            <button class="btn btn-dark" title="Eliminar la cuota">
                                <a href="{{ route('cuotas.delete', $item->id) }}" class="text-decoration-none text-danger">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $cuotas->links() }}
@endsection