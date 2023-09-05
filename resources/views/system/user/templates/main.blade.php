<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PEOPLEPRO - @yield('title')</title>

    {{-- CSS interno --}}
    <link rel="stylesheet" href="/css/system/user/style.css">

    {{-- Ícone de sistema --}}
    <link rel="shortcut icon" href="/files/images/png/admin/icon-fav.png" type="image/x-icon">

    {{-- Bootstrap CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>

    <header>
        <nav class="navbar navbar-dark bg-dark fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('system.user.home') }}">PEOPLEPRO</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar"
                    aria-labelledby="offcanvasDarkNavbarLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Menu</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                            <li class="nav-item">
                                <a class="nav-link" href="#">Cargos <i class="bi bi-person-vcard"></i></a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="#">Colaboradores <i
                                        class="bi bi-people-fill"></i></a>
                            </li>

                            <hr>

                            <li class="nav-item">
                                <a class="nav-link" href="#">Benefícios <i class="bi bi-bag-heart"></i></a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#">Documentos <i class="bi bi-folder"></i></a>
                            </li>

                            <hr>

                            <li class="nav-item">
                                <a class="nav-link" href="#">Férias <i class="bi bi-calendar-range"></i></a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#">Financeiro <i class="bi bi-cash-stack"></i></a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#">Ponto <i class="bi bi-calendar-week"></i></a>
                            </li>

                            <hr>

                            <li class="nav-item">
                                <a class="nav-link" href="#">Sair <i class="bi bi-box-arrow-right"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    @yield('content-page')
</body>
</html>