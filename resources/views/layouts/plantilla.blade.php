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
</head>
<body>
    <header>
        <div class="container d-flex align-items-center justify-content-between">
            <h1 class="m-0 p-0"><i class="fa-solid fa-building me-2"></i>Bunglebuild S.L.</h1>
            <div class="text-end">
                @if (isset($usuario))
                    <p class="m-0 fs-5">Has iniciado sesión con <span class="fw-bold">{{ $usuario->usuario }}</span><span class="fw-bold fst-italic text-dark">#{{ $usuario->id }}</span></p>
                    <p class="m-0">
                        Estás en modo: <span class="fw-bold">{{ $usuario->tipo == 0 ? 'ADMINISTRADOR' : 'OPERADOR' }}</span>
                        <span class="px-3">|</span>
                        Último inicio de sesión: <span class="fw-bold">{{ $usuario->ultimo_login }}</span>
                    </p>
                    <form action="{{ route('login.logout') }}" method="POST">
                        <button type="submit" class="mt-2 btn btn-dark"><i class="fa-solid fa-right-to-bracket me-2"></i>Cerrar sesión</button>
                    </form>
                @endif
            </div>
        </div>
    </header>
    
    <main class="container">
        <nav>
            <ul>
                <li><a href="/"># Inicio</a></li>
                @if (isset($usuario) && $usuario->esAdmin())
                    <li><a href="{{route('usuarios.show')}}"># Ver lista usuarios</a></li>
                    <li><a href="{{route('usuarios.create')}}"># Añadir usuario</a></li>
                @endif
                {{-- <li><a href="{{route('tareas.index')}}"># Ver lista tareas</a></li> --}}
                @if (isset($usuario) && $usuario->esAdmin())
                    <li><a href="{{route('tareas.create')}}"># Añadir tarea</a></li>
                @endif
                {{-- <li><a href="{{route('tareas.search')}}"># Buscar o filtrar tareas</a></li> --}}
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
            &copy; - 2023
        </div>
    </footer>
</body>
</html>