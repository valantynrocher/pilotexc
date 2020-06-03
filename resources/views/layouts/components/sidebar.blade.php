<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('dashboard.index')}}" class="brand-link">
        <img src="{{ asset('img/AdminLTELogo.png') }}" alt="Pilotexc Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">PILOTEXC</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('dashboard.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Tableau de bord</p>
                    </a>
                </li>

                {{-- <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Utilisateurs</p>
                    </a>
                </li> --}}

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-list"></i>
                      <p>Plans de compte <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="{{ route('analyticAccounts.index') }}" class="nav-link">
                          <i class="fas fa-angle-right"></i>
                          <p>Analytique</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ route('generalAccounts.index') }}" class="nav-link">
                          <i class="fas fa-angle-right"></i>
                          <p>Générale</p>
                        </a>
                      </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ route('scriptures.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>Gestion des écritures</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('parameters.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>Paramètres</p>
                    </a>
                </li>

                {{-- <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-share-alt"></i>
                        <p>Automation</p>
                    </a>
                </li> --}}

                {{-- <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-file-export"></i>
                        <p>Export</p>
                    </a>
                </li> --}}
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
