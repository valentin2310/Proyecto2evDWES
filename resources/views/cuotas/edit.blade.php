@php    
/**
 * @author: Valentin Andrei Culea
 * @date: 24/01/2024
 * @version 2
 */
@endphp

@extends('layouts/plantilla')

@section('titulo', 'Corregir cuota')

@section('contenido')

<div class="d-flex flex-column align-items-center gap-3">

    <h1>Corregir cuota</h1>

    <form action="{{ route('cuotas.update', $cuota) }}" method="POST" class="form bg-dark text-white p-4 rounded">
        @csrf
        @method('put')
    
        <fieldset>
            <legend class="text-azul">Datos de la cuota</legend>
            <div class="row m-0 p-4">
                <x-form_control 
                    name="concepto" label="Concepto"
                    col="12" :value="$cuota->concepto"
                    placeholder="Ej: Realización de la tarea 2.."
                />
                <x-form_select 
                    name="id_cliente" label="Cliente"
                    :list="$clientes" :value="$cuota->cliente->id"
                    icon="fa-solid fa-user" col="8"
                    show="nombre"
                >
                </x-form_select>
                <x-form_control 
                    name="importe" label="Importe(€)" 
                    icon="fa-solid fa-sack-dollar" col="4"
                    type="number" step="0.001" :value="$cuota->importe"
                />
                @if ($cuota->tarea)
                    <x-form_select 
                        name="id_tarea" label="Tarea"
                        :list="$tareas" :value="$cuota->tarea->id"
                        icon="fa-solid fa-list-check" col="12"
                        show="descripcion" show2="id"
                    >
                @endif
                </x-form_select>
                <x-form_control 
                    name="notas" label="Notas"
                    col="12" :value="$cuota->notas"
                    placeholder="Ej: Una nota cualquiera.."
                />
                <label class="form-label">¿Pagada?:</label>
                <div class="col-md-12 mb-3">
                    <div class="form-chek">
                        <input type="radio" name="pagada" value="1" class="form-check-input" @checked(old('pagada', $cuota->pagada) == 1)>
                        <label class="form-check-label">Sí</label>
                    </div>
                    <div class="form-chek">
                        <input type="radio" name="pagada" value="0" class="form-check-input" @checked(old('pagada', $cuota->pagada) == 0)>
                        <label class="form-check-label">No</label>
                    </div>
                </div>
                <x-form_control 
                    name="fecha_pago" label="Fecha de pago" 
                    col="12" :value="$cuota->fecha_pago"
                />
            </div>
        </fieldset>
        <div class="text-center">
            <button type="submit" class="btn btn-primary my-3"><i class="fa-solid fa-floppy-disk me-2"></i>Guardar cuota</button>
        </div>
    </form>

</div>

@endsection