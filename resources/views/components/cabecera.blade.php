<header>
    <div class="container d-flex align-items-center justify-content-between">
        <h1 class="m-0 p-0">
            <a href="{{ route('home') }}" class="text-decoration-none text-white">
                <i class="fa-solid fa-building me-2"></i>Bunglebuild S.L.
            </a>
        </h1>

        <div class="text-end">
            @guest
                <a href="{{ route('login') }}" class="text-decoration-none">
                    <button class="btn btn-dark"><i class="fa-solid fa-circle-user me-2"></i>Iniciar sesión</button>
                </a>
            @endguest

            @auth
                <p class="m-0 fs-5">Has iniciado sesión con <span class="fw-bold">{{ Auth::user()->nombre }}</span><span class="fw-bold fst-italic text-dark">#{{ Auth::user()->id }}</span></p>
                <p class="m-0">
                    Estás en modo: <span class="fw-bold">{{ Auth::user()->tipo == 0 ? 'ADMINISTRADOR' : 'OPERADOR' }}</span>
                    <span class="px-3">|</span>
                    Último inicio de sesión: <span class="fw-bold">{{ Auth::user()->ultimo_login }}</span>
                </p>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="mt-2 btn btn-dark"><i class="fa-solid fa-right-to-bracket me-2"></i>Cerrar sesión</button>
                </form>
            @endauth
        </div>
    </div>
</header>