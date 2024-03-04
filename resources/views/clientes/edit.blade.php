@php    
/**
 * @author: Valentin Andrei Culea
 * @date: 25/01/2024
 * @version 2
 */
@endphp

@extends('layouts/plantilla')

@section('titulo', 'Modificar cliente ' . $cliente->id)

@section('contenido')

<div class="d-flex flex-column align-items-center gap-3">

    <h1>Modificar cliente</h1>

    <form action="{{ route('clientes.update', $cliente) }}" method="POST" class="form bg-dark text-white p-4 rounded">
        @csrf
        @method('put')
    
        <input type="hidden" name="id" value="{{ $cliente->id }}">
        <fieldset>
            <legend class="text-azul">Datos del cliente</legend>
            <div class="row m-0 p-4">
                <x-form_control 
                    name="cif" label="CIF"
                    :value="$cliente->cif"
                    icon="fa-solid fa-address-card" col="6"
                    placeholder="Ej: Q3032789D.."
                />
                <x-form_control 
                    name="nombre" label="Nombre"
                    :value="$cliente->nombre"
                    icon="fa-solid fa-user-tag" col="6"
                    placeholder="Ej: Juanito Flores SL.."
                />
                <x-form_control 
                    name="telefono" label="Teléfono" 
                    :value="$cliente->telefono"
                    icon="fa-solid fa-phone" col="6"
                    placeholder="Ej: 921843765"
                />
                <x-form_control 
                    name="correo" label="Correo" 
                    :value="$cliente->correo"
                    icon="fa-solid fa-envelope" col="12"
                    placeholder="Ej: example@example.com"
                />
                <x-form_control 
                    name="passwd" label="Contraseña" 
                    :value="$cliente->passwd"
                    icon="fa-solid fa-key" col="6" type="password"
                />
                <x-form_control 
                    name="passwd_2" label="Repite la contraseña" 
                    :value="$cliente->passwd"
                    icon="fa-solid fa-key" col="6" type="password"
                />
            </div>

            <legend class="text-azul">Datos de facturación</legend>
            <div class="row m-0 p-4">
                <x-form_control 
                    name="cuenta_corriente" label="Cuenta corriente" 
                    :value="$cliente->cuenta_corriente"
                    icon="fa-solid fa-credit-card" col="12"
                    placeholder="Ej: ES72 2080 8373 7774 9277 0286"
                />
                <x-form_select 
                    name="id_pais" label="País"
                    :list="$paises" :value="$cliente->id_pais"
                    icon="fa-solid fa-globe" col="4"
                    show2="iso"
                >
                </x-form_select>
                <x-form_select 
                    name="id_moneda" label="Moneda"
                    :list="$monedas" :value="$cliente->id_moneda"
                    icon="fa-solid fa-coins" col="4"
                    show2="code" show3="symbol"
                >
                </x-form_select>
                <x-form_control 
                    name="cuota_mensual" label="(€) Cuota mensual"
                    :value="$cliente->cuota_mensual"
                    icon="fa-solid fa-sack-dollar" col="4" 
                    type="number" step="0.001"
                />
            </div>
        </fieldset>
        <div class="text-center">
            <button type="submit" class="btn btn-primary my-3"><i class="fa-solid fa-floppy-disk me-2"></i>Guardar cliente</button>
        </div>
    </form>

</div>

@endsection