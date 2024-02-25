<?php
/**
 * @author: Valentin Andrei Culea
 * @date: 24/02/2024
 * @version 2
 */
?>
@extends('layouts/simple')

@section('titulo', 'Cuota pdf')

@section('contenido')
    <section>
        <h1 class="text-azul"><i class="fa-solid fa-circle-info me-3"></i>Datos del cliente</h1>
        <div class="row m-0 px-4 py-2">
            <div class="col-md-6">
                <p><span class="fw-bold">CIF: </span>{{ $cuota->cliente->cif }}</p>
            </div>
            <div class="col-md-12">
                <p><span class="fw-bold">Nombre: </span>{{ $cuota->cliente->nombre }}</p>
            </div>
            <div class="col-md-6">
                <p><span class="fw-bold">País: </span>{{ $cuota->cliente->pais->name }}</p>
            </div>
        </div>
    </section>
    
    <section>
        <h1 class="text-azul"><i class="fa-solid fa-circle-info me-3"></i>Datos de la factura</h1>
        <div class="row m-0 px-4 py-2">
            <div class="col-md-6">
                <p><span class="fw-bold">Nº Factura: </span>{{ $cuota->id }}</p>
            </div>
            <div class="col-md-6">
                <p><span class="fw-bold">Concepto: </span>{{ $cuota->concepto }}</p>
            </div>
            <div class="col-md-6">
                <p><span class="fw-bold">Importe: </span>{{ $cuota->importe }} {{ $cuota->cliente->moneda->symbol }}</p>
            </div>
            <div class="col-md-6">
                <p><span class="fw-bold">Fecha emisión: </span>{{ $cuota->fecha_emision->format('d/m/Y') }}</p>
            </div>
            <div class="col-md-6">
                <p><span class="fw-bold">Notas: </span>{{ $cuota->notas ?? 'Ninguna' }}</p>
            </div>
        </div>
    </section>

   {{--  <ul>
        <li>{{ $cuota->cliente->nombre }}</li>
        <li>{{ $cuota->concepto }}</li>
        <li>{{ $cuota->importe }} {{ $cuota->cliente->moneda->symbol }}</li>
        <li>{{ $cuota->tarea ? 'Si' : 'No' }}</li>
        <li>{{ $cuota->fecha_emision->format('d/m/Y') }}</li>
        <li>{{ $cuota->pagada ? 'Si' : 'No' }}</li>
        <li>{{ $cuota->fecha_pago }}</li>
        <li>{{ $cuota->notas ?? 'Sin notas' }}</li>
    </ul> --}}
                       
@endsection