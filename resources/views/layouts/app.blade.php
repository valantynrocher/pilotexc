<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>@yield('title') | DEMO Pilotexc</title>

        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">


        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}"">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">


        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">


        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('css/adminlte.css') }}">
        <!-- Custom style -->
        <link rel="stylesheet" href="{{ asset('css/pilotexc.css') }}">

        @yield('head')
    </head>

    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">

            <!-- Top Navbar -->
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
            <!-- /.navbar -->

            <!-- Sidebar -->
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

            <!-- Content Wrapper -->
            <div class="content-wrapper p-3">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-5">
                            <div class="col">
                                <h1>@yield('title')</h1>
                            </div>
                        </div>
                    </div><!-- /.container-fluid -->
                </section>

                <!-- Content Header (Page header) -->
                <section class="content-body">
                    <!-- page content -->
                    @yield('content')
                    <!-- /. page content -->
                </section>
            </div>
            <!-- /.content-wrapper -->

            <footer class="main-footer">
                <strong>Copyright &copy; 2020 <a href="#">Pilotexc</a>.</strong>
                Tous droits réservés.
                <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.0.0
                </div>
            </footer>
        </div>
        <!-- ./wrapper -->

        <!-- jQuery -->
        <script src="{{ asset('js/app.js') }}"></script>

        <!-- jQuery UI 1.11.4 -->
        <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>

        <!-- AdminLTE App -->
        <script src="{{ asset('js/adminlte.js') }}"></script>

        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button)
        </script>
        @yield('script')
    </body>
</html>
