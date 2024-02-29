<?php
/**
 * @author Valentin Andrei Culea
 * @date 08/01/2024
 * @version 2
 */
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo')</title>
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/0a879c88fe.js" crossorigin="anonymous"></script>
    <!-- Mis estilos -->
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tarea.css') }}">
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
</head>
<body>
    
    <x-cabecera>
        
    </x-cabecera>
    
    <main class="container">
        <nav>
            <ul>
                <li><a href="{{route('home')}}" class="{{ request()->routeIs('home') ? 'active' : '' }}"># Inicio</a></li>
                @auth
                    <li><a href="{{route('tareas.index')}}" class="{{ request()->routeIs('tareas.index') ? 'active' : '' }}"># Ver lista tareas</a></li>
                    @if (Auth::user()->esAdmin())
                        <li><a href="{{route('tareas.search')}}" class="{{ request()->routeIs('tareas.search') ? 'active' : '' }}"># Buscar o filtrar tareas</a></li>
                    @endif
                @endauth
                @if (!Auth::user() || Auth::user()->esAdmin())
                    <li><a href="{{route('tareas.create')}}" class="{{ request()->routeIs('tareas.create') ? 'active' : '' }}"># Añadir tarea</a></li>
                @endif
                @auth
                    @if (Auth::user()->esAdmin())
                        <li><a href="{{route('empleados.show')}}" class="{{ request()->routeIs('empleados.show') ? 'active' : '' }}"># Ver lista empleados</a></li>
                        <li><a href="{{route('empleados.create')}}" class="{{ request()->routeIs('empleados.create') ? 'active' : '' }}"># Añadir empleado</a></li>
                        <li><a href="{{route('clientes.show')}}" class="{{ request()->routeIs('clientes.show') ? 'active' : '' }}"># Ver lista clientes</a></li>
                        <li><a href="{{route('clientes.create')}}" class="{{ request()->routeIs('clientes.create') ? 'active' : '' }}"># Añadir cliente</a></li>
                        <li><a href="{{route('cuotas.show')}}" class="{{ request()->routeIs('cuotas.show') ? 'active' : '' }}"># Ver lista cuotas</a></li>
                        <li><a href="{{route('cuotas.create')}}" class="{{ request()->routeIs('cuotas.create') ? 'active' : '' }}"># Añadir cuota</a></li>
                    @endif
                @endauth
            </ul>
        </nav>

        <div class="pagina">
            @yield('contenido')
        </div>
    </main>
        

    <footer>
        <div class="container">
            Creado por Valentin AC 
            <br>
            &copy; - 2024
        </div>
    </footer>
</body>
</html>