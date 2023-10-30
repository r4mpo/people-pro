@php
    $url_atual = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    use App\Models\User;
@endphp

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PEOPLEPRO - @yield('title')</title>

    <link href="/template/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="/template/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="/template/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="/css/system/user/style.css" rel="stylesheet">
    <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">
</head>

<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-fw fa-user-cog"></i>
                </div>
                <div class="sidebar-brand-text mx-3">PEOPLEPRO</div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item @if ($url_atual == route('dashboard') . '/') active @endif">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Geral</span></a>
            </li>


            @canany([User::VISUALIZAR_COLABORADORES, User::VISUALIZAR_FINANCEIROS, User::VISUALIZAR_CARGOS,
                User::VISUALIZAR_SETORES])
                <hr class="sidebar-divider">
                <div class="sidebar-heading">
                    Gestão de pessoas
                </div>
                @canany([User::VISUALIZAR_COLABORADORES, User::VISUALIZAR_FINANCEIROS])
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                            aria-expanded="true" aria-controls="collapseTwo">
                            <i class="fas fa-fw fa-users"></i>
                            <span>Colaboradores</span>
                        </a>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header">Colaboradores:</h6>
                                @can(User::VISUALIZAR_COLABORADORES)
                                    <a class="collapse-item @if ($url_atual == route('sistema.usuario.colaboradores.entrar')) active @endif"
                                        href="{{ route('sistema.usuario.colaboradores.entrar') }}">Colaboradores</a>
                                @endcan
                                @can(User::VISUALIZAR_FINANCEIROS)
                                    <a class="collapse-item @if ($url_atual == route('sistema.usuario.financeiros.entrar')) active @endif"
                                        href="{{ route('sistema.usuario.financeiros.entrar') }}">Financeiro</a>
                                @endcan
                            </div>
                        </div>
                    </li>
                @endcanany
                @canany([User::VISUALIZAR_CARGOS, User::VISUALIZAR_SETORES])
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                            aria-expanded="true" aria-controls="collapseUtilities">
                            <i class="fas fa-fw fa-user-tag"></i>
                            <span>Cargos</span>
                        </a>
                        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                            data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header">Cargos:</h6>
                                @can(User::VISUALIZAR_CARGOS)
                                    <a class="collapse-item @if ($url_atual == route('sistema.usuario.cargos.entrar')) active @endif"
                                        href="{{ route('sistema.usuario.cargos.entrar') }}">Cargos</a>
                                @endcan
                                @can(User::VISUALIZAR_SETORES)
                                    <a class="collapse-item @if ($url_atual == route('sistema.usuario.setores.entrar')) active @endif"
                                        href="{{ route('sistema.usuario.setores.entrar') }}">Setores</a>
                                @endcan
                            </div>
                        </div>
                    </li>
                @endcanany
            @endcanany

            @canany([User::VISUALIZAR_INFORMACOES_EMPRESA, User::VISUALIZAR_BENEFICIOS])
                <hr class="sidebar-divider">

                <div class="sidebar-heading">
                    Outras informações
                </div>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                        aria-expanded="true" aria-controls="collapsePages">
                        <i class="fas fa-fw fa-cog"></i>
                        <span>Corporação</span>
                    </a>
                    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Corporação:</h6>
                            @can(User::VISUALIZAR_INFORMACOES_EMPRESA)
                                <a class="collapse-item @if ($url_atual == route('sistema.usuario.empresa.entrar')) active @endif"
                                    href="{{ route('sistema.usuario.empresa.entrar') }}">Empresa</a>
                            @endcan
                            @can(User::VISUALIZAR_BENEFICIOS)
                                <a class="collapse-item @if ($url_atual == route('sistema.usuario.beneficios.entrar')) active @endif"
                                    href="{{ route('sistema.usuario.beneficios.entrar') }}">Benefícios</a>
                            @endcan
                        </div>
                    </div>
                </li>
            @endcanany

            @canany([User::VISUALIZAR_PERFIS_ACESSO, User::VISUALIZAR_PERFIS_USUARIOS])
                <hr class="sidebar-divider">

                <div class="sidebar-heading">
                    Administração
                </div>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                        aria-expanded="true" aria-controls="collapsePages">
                        <i class="fas fa-fw fa-cog"></i>
                        <span>Controle</span>
                    </a>
                    <div id="collapsePages" class="collapse" aria-labelledby="headingPages"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Acessos:</h6>
                            @can(User::VISUALIZAR_PERFIS_ACESSO)
                                <a class="collapse-item @if ($url_atual == route('system.admin.perfis.index')) active @endif"
                                    href="{{ route('system.admin.perfis.index') }}">Perfis</a>
                            @endcan
                        </div>
                    </div>
                </li>
            @endcanany

            <hr class="sidebar-divider d-none d-md-block">

            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-dark topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                                <img class="img-profile rounded-circle" src="/template/img/undraw_profile.svg">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="/profile">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Perfil
                                </a>
                                <div class="dropdown-divider"></div>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Sair
                                    </button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </nav>
                <div class="container-fluid">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Atenção:</strong> {{ session('success') }}
                        </div>
                    @elseif ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ $error }}
                            </div>
                        @endforeach
                    @endif
                    @yield('content-page')
                </div>
            </div>
            <footer class="sticky-footer bg-dark">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Direitos Reservados &copy; - PEOPLEPRO {{ date('Y') }}</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <script src="/template/vendor/jquery/jquery.min.js"></script>
    <script src="/template/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/template/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="/template/js/sb-admin-2.min.js"></script>
    @yield('scripts')
</body>

</html>
