@php    
/**
 * @author: Valentin Andrei Culea
 * @date: 24/01/2024
 * @version 2
 */
@endphp

@extends('layouts/plantilla')

@section('titulo', 'Nuevo cliente')

@section('contenido')

<div class="d-flex flex-column align-items-center gap-3">

    <h1>Añadir cliente</h1>

    <form action="{{ route('clientes.store') }}" method="POST" class="form bg-dark text-white p-4 rounded">
        @csrf
    
        <fieldset>
            <legend class="text-azul">Datos del cliente</legend>
            <div class="row m-0 p-4">
                <div class="col-md-6 mb-3">
                    <label class="form-label"><i class="fa-solid fa-address-card me-2"></i>CIF:</label>
                    <input type="text" name="cif" class="form-control"
                        value="{{ old('cif') }}"
                    >
                    @error('cif')
                        <x-msg_error :message="$message" />
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label"><i class="fa-solid fa-user-tag me-2"></i>Nombre:</label>
                    <input type="text" name="nombre" class="form-control"
                        value="{{ old('nombre') }}"
                    >
                    @error('nombre')
                        <x-msg_error :message="$message" />
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label"><i class="fa-solid fa-phone me-2"></i>Teléfono:</label>
                    <input type="text" name="telefono" class="form-control"
                        value="{{ old('telefono') }}"
                    >
                    @error('telefono')
                        <x-msg_error :message="$message" />
                    @enderror
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label"><i class="fa-solid fa-envelope me-2"></i>Correo:</label>
                    <input type="text" name="correo" class="form-control"
                        value="{{ old('correo') }}"
                    >
                    @error('correo')
                        <x-msg_error :message="$message" />
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label"><i class="fa-solid fa-key me-2"></i>Contraseña:</label>
                    <input type="password" name="passwd" class="form-control"
                       value="{{ old('passwd') }}"
                    >
                    @error('passwd')
                        <x-msg_error :message="$message" />
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label"><i class="fa-solid fa-key me-2"></i>Repite la contraseña:</label>
                    <input type="password" name="passwd_2" class="form-control"
                       value="{{ old('passwd_2') }}"
                    >
                    @error('passwd_2')
                        <x-msg_error :message="$message" />
                    @enderror
                </div>
            </div>

            <legend class="text-azul">Datos de facturación</legend>
            <div class="row m-0 p-4">
                <div class="col-md-12 mb-3">
                    <label class="form-label"><i class="fa-solid fa-credit-card me-2"></i>Cuenta corriente:</label>
                    <input type="text" name="cuenta_corriente" class="form-control"
                        value="{{ old('cuenta_corriente') }}"
                    >
                    @error('cuenta_corriente')
                        <x-msg_error :message="$message" />
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label"><i class="fa-solid fa-globe me-2"></i>País:</label>
                    <select name="id_pais" class="form-select">
                        @foreach ($paises as $item)
                            <option value="{{ $item->id }}" @selected($item->id == old('id_pais'))>
                                {{ $item->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_pais')
                        <x-msg_error :message="$message" />
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label"><i class="fa-solid fa-coins me-2"></i>Moneda:</label>
                    <select name="id_moneda" class="form-select">
                        @foreach ($monedas as $item)
                            <option value="{{ $item->id }}" @selected($item->id == old('id_moneda'))>
                                {{ $item->name }}({{ $item->symbol }})
                            </option>
                        @endforeach
                    </select>
                    @error('id_moneda')
                        <x-msg_error :message="$message" />
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label"><i class="fa-solid fa-sack-dollar me-2"></i>Cuota mensual:</label>
                    <input type="number" step="0.001" name="cuota_mensual" class="form-control"
                        value="{{ old('cuota_mensual', 0) }}"
                    >
                    @error('cuota_mensual')
                        <x-msg_error :message="$message" />
                    @enderror
                </div>
            </div>
        </fieldset>
        <div class="text-center">
            <button type="submit" class="btn btn-primary my-3"><i class="fa-solid fa-floppy-disk me-2"></i>Guardar cliente</button>
        </div>
    </form>

</div>

@endsection
{{-- 
<div class="col-md-6 mb-3">
    <label class="form-label"><i class="fa-solid fa-user-tie me-2"></i>Tipo de empleado:</label>
    <select name="tipo" class="form-select">
        <option value="1" @selected(old('tipo') == '1')>Operario</option>
        <option value="0" @selected(old('tipo') == '0')>Administrador</option>
    </select>
    @error('tipo')
        <x-msg_error :message="$message" />
    @enderror
</div> --}}