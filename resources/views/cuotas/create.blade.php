@php    
/**
 * @author: Valentin Andrei Culea
 * @date: 24/01/2024
 * @version 2
 */
@endphp

@extends('layouts/plantilla')

@section('titulo', 'Nueva cuota')

@section('contenido')

<div class="d-flex flex-column align-items-center gap-3">

    <h1>Añadir cuota excepcional</h1>

    <form action="{{ route('cuotas.store') }}" method="POST" class="form bg-dark text-white p-4 rounded">
        @csrf
    
        <fieldset>
            <legend class="text-azul">Datos de la cuota</legend>
            <div class="row m-0 p-4">
                <x-form_control 
                    name="concepto" label="Concepto"
                    col="12"
                    placeholder="Ej: Realización de la tarea 2.."
                />
                <x-form_select 
                    name="id_cliente" label="Cliente"
                    :list="$clientes"
                    icon="fa-solid fa-user" col="8"
                    show="nombre"
                >
                </x-form_select>
                <x-form_control 
                    name="importe" label="Importe(€)" 
                    icon="fa-solid fa-sack-dollar" col="4"
                    type="number" step="0.001" value="0"
                />
                <x-form_select 
                    name="id_tarea" label="Tarea"
                    :list="$tareas"
                    icon="fa-solid fa-list-check" col="12"
                    show="descripcion" show2="id"
                >
                </x-form_select>
                <x-form_control 
                    name="notas" label="Notas"
                    col="12"
                    placeholder="Ej: Una nota cualquiera.."
                />
            </div>
        </fieldset>
        <div class="text-center">
            <button type="submit" class="btn btn-primary my-3"><i class="fa-solid fa-floppy-disk me-2"></i>Guardar cuota</button>
        </div>
    </form>

</div>

@endsection