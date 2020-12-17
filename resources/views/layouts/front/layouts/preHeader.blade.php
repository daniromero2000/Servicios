<div id="preHeader">
    <div class="container-itemsPreHeader">
        <a class="preHeader-item  borderLeftItems" href="/quienes-somos">Quiénes somos</a>
        <a class="preHeader-item  borderLeftItems" href="/Nuestras-tiendas">Oficinas</a>
        <a class="preHeader-item  borderLeftItems" href="#">01 8000 18 05 20 o (1) 484 2122 en Bogotá</a>
        <a class="preHeader-item " href="/Terminos-y-condiciones">* Aplican condiciones y restricciones</a>
        @if (Auth::guard('web')->check())
            <div class="logoutButton mr-2">
                <a href=" /Administrator/dashboard" class="badge badge-primary" style="font-size: 13px;">
                    <i class="fas fa-sign-out-alt"></i></i> Volver
                </a>
                <a href=" {{ route('logout') }}" class="badge badge-danger" style="font-size: 13px;">
                    <i class="fas fa-power-off"></i> Cerrar Sesion
                </a>

            </div>

        @elseif(Auth::guard('assessor')->check())

            <div class="logoutButton">
                <a class="dropdown-item" href="{{ route('assessor.logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('assessor.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>

        @else

            <div class="assesorLogin ">
                <a class="ingreso" href="/login">Ingreso asesores</a>
                <p>{{ Auth::user() }}</p>
            </div>
        @endif
    </div>
</div>
