<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links-->
    <ul class="navbar-nav">
        <!-- show/hide sidebar toggle-->
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Account Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <img src="{{ asset('img/logo.png') }}" class="navbar-logo float-left mr-2" alt="Logo de l'entreprise">
                <span>Utilisateur {{-- {{ Auth::user()->name }}--}}</span>
                <i class="fas fa-sort-down ml-2"></i>
            </a>

            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="#" class="dropdown-item">
                    <i class="fas fa-user mr-2"></i>
                    Mon compte
                </a>

                <div class="dropdown-divider"></div>

                <a href="#" class="dropdown-item">
                    <i class="fas fa-briefcase mr-2"></i>
                    Mon entreprise
                </a>

                <div class="dropdown-divider"></div>

                <!-- Logout -->
                <div>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-power-off mr-2"></i>
                        {{ __('Déconnexion') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link" href="#">
                <span>Aide ?</span>
            </a>
        </li>
    </ul>
</nav>
