<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PEOPLEPRO - @yield('title')</title>

    {{-- Ícone de sistema --}}
    <link rel="shortcut icon" href="/files/images/png/admin/icon-fav.png" type="image/x-icon">

    <link href="/auth/template/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/auth/template/assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="/auth/template/assets/css/style.css" rel="stylesheet">

    {{-- Nosso arquivo .js externo --}}
    <script src="/js/masks.js"></script>
</head>

<body>
    @yield('content-page')
</body>
</html>