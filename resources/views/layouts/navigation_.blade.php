<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a href="#" class="navbar-brand"> </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link" aria-current="page">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('permiso.index') }}" class="nav-link">Permisos</a>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Registrar
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('permiso.create') }}" class="dropdown-item">Permiso (propio)</a></li>
                        <li><a href="{{ route('permiso.permiso_comp') }}" class="dropdown-item">Permiso (compañero)</a>
                            <li><a href="{{ route('autorizacion-permiso') }}" class="dropdown-item">autorizacion permiso</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('permiso.disponibilidad') }}" class="nav-link">Disponibilidad</a>
                </li>
            </ul>

            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->empleado }}
                        </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a href="{{ route('profile.edit') }}" class="dropdown-item">Perfil</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <li><a href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); this.closest('form').submit();"
                                        class="dropdown-item">Salir</a></li>
                            </form>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>