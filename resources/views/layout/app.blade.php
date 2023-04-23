<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    <link rel="stylesheet" href="./css/app.css">
    @yield('stylesImports')
    <title>@yield('title')</title>
</head>
<body>
    @include('layout.navbar')
    <div class="main">
        @yield('main')
    </div>
    @include('layout.footer')
    <script src="./js/app.js"></script>
</body>
</html>
