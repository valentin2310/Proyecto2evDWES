<?php
/**
 * @author: Valentin Andrei Culea
 * @date: 01/01/2024
 * @version 2
 */
?>
@extends('layouts.plantilla')

@section('titulo', 'Tarea '.$tarea->id)

@section('contenido')
    
    <section>
        <h1 class="text-azul"><i class="fa-solid fa-circle-info me-3"></i>Datos de la tarea</h1>
        <div class="row m-0 px-4 py-2">
            <div class="col-md-6">
                <p><span class="fw-bold">Id factura: </span>{{ $tarea->id }}</p>
            </div>
            <div class="col-md-6">
                <p><span class="fw-bold">Estado: </span>{{ $tarea->getEstado() }}</p>
            </div>
            <div class="col-md-12">
                <p><span class="fw-bold">NIF facturador: </span>{{ $tarea->nif }}</p>
            </div>
            <div class="col-md-12">
                <p><span class="fw-bold">Operario: </span>{{ $tarea->operario->nombre ?? 'Ninguno' }}</p>
            </div>
            <div class="col-md-12">
                <p><span class="fw-bold">Descripción: </span>{{ $tarea->descripcion }}</p>
            </div>
            <div class="col-md-6">
                <p><span class="fw-bold">Fecha creación: </span>{{ $tarea->fecha_creacion->format('d/m/Y') }}</p>
            </div>
            <div class="col-md-6">
                @if (isset($tarea->fecha_realizacion))
                    <p><span class="fw-bold">Fecha realización: </span>{{ $tarea->fecha_realizacion }}</p>
                @else
                    <p><span class="fw-bold">Fecha realización: </span>Sin fecha</p>
                @endif
            </div>
        </div>
    </section>

    <section>
        <h1 class="text-azul"><i class="fa-solid fa-gear me-3"></i>Acciones</h1>
        <div class="px-4 py-2">
            @auth
                @if (!Auth::user()->esADmin())
                    <button class="btn btn-dark fw-bold">
                        <a href="{{ route('tareas.completar', $tarea->id) }}" class="text-decoration-none text-success">
                            <i class="fa-solid fa-circle-check me-2"></i>
                            Completar tarea
                        </a>
                    </button>
                @else
                    <button class="btn btn-dark fw-bold">
                        <a href="{{ route('tareas.edit', $tarea->id) }}" class="text-decoration-none text-warning">
                            <i class="fa-solid fa-pen me-2"></i>
                            Modificar
                        </a>
                    </button>
                    <button class="btn btn-danger fw-bold">
                        <a href="{{ route('tareas.delete', $tarea->id) }}" class="text-decoration-none text-white">
                            <i class="fa-solid fa-trash-can me-2"></i>
                            Eliminar
                        </a>
                    </button>
                @endif
            @endauth
        </div>
    </section>

    <section>
        <h1 class="text-azul"><i class="fa-solid fa-address-book me-3"></i>Datos contacto</h1>
        <div class="row m-0 px-4 py-2">
            <div class="col-md-6">
                <p><span class="fw-bold">Persona de contacto: </span>{{ $tarea->contacto ?? 'Ninguno' }}</p>
            </div>
            <div class="col-md-6">
                <p><span class="fw-bold">Teléfono de contacto: </span>{{ $tarea->telefono ?? 'Ninguno' }}</p>
            </div>
            <div class="col-md-12">
                <p><span class="fw-bold">Correo de contacto: </span>{{ $tarea->correo }}</p>
            </div>
        </div>
    </section>

    <section>
        <h1 class="text-azul"><i class="fa-solid fa-location-dot me-3"></i>Datos de ubicación</h1>
        <div class="row m-0 px-4 py-2">
            <div class="col-md-12">
                <p><span class="fw-bold">Dirección: </span>{{ $tarea->direccion ?? 'Sin dirección' }}</p>
            </div>
            <div class="col-md-6">
                <p><span class="fw-bold">Provincia: </span>{{ $tarea->provincia->nombre ?? 'Ninguna' }}</p>
            </div>
            <div class="col-md-6">
                <p><span class="fw-bold">Población: </span>{{ $tarea->poblacion ?? 'Ninguna' }}</p>
            </div>
            <div class="col-md-12">
                <p><span class="fw-bold">Código postal: </span>{{ $tarea->cod_postal ?? 'Ninguno' }}</p>
            </div>
        </div>
    </section>

    <section>
        <h1 class="text-azul"><i class="fa-solid fa-note-sticky me-3"></i>Anotaciones</h1>
        <div class="row m-0 px-4 py-2">
            <div class="col-md-12">
                <p><span class="fw-bold">Anotaciones anteriores: </span>{{ $tarea->anotaciones_a ?? 'Ninguna' }}</p>
            </div>
            <div class="col-md-12">
                <p><span class="fw-bold">Anotaciones posteriores: </span>{{ $tarea->anotaciones_p ?? 'Ninguna' }}</p>
            </div>
        </div>
    </section>

    <section>
        <h1 class="text-azul"><i class="fa-solid fa-file me-3"></i>Fichero resumen</h1>
        <div class="px-4 py-2">
            @if ($tarea->fichero)
                <a href="{{ asset('storage/' . $tarea->fichero) }}" target="_blank">Ver archivo</a>
            @else
                No hay ningun archivo..
            @endif
        </div>
    </section>

    <section>
        <h1 class="text-azul"><i class="fa-solid fa-image me-3"></i>Fotos del trabajo realizado</h1>
        <div class="px-4 py-2">
            @if ($tarea->imagenes->count() > 0)
                <p>Hay {{ $tarea->imagenes->count() }} fotos: </p>
                <div class="fotos my-3 d-flex flex-wrap justify-content-center align-items-center gap-1">
                    @foreach ($tarea->imagenes as $img)
                        <div class="foto-card">
                            <img src="{{ asset('storage/' . $img['path']) }}" width="200" alt="Imagen de la tarea">
                        </div>
                    @endforeach
                </div>
            @else
                <p>No hay ninguna foto</p>
            @endif
        </div>
    </section>
    
@endsection