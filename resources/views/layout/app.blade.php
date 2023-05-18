<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- <link rel="stylesheet" href="{{asset('css/app.css')}}"> --}}
    @yield('stylesImports')
    <title>@yield('title')</title>
</head>
<body>
    @include('layout.navbar')
    <div class="main">
        @yield('main')
    </div>
    @if (!str_contains(Request::path(), 'admin'))
    @include('layout.footer')
    @endif

    @if (str_contains(Request::path(), 'admin'))
    @vite('resources/js/admin.js')
    @endif

    {{-- <script src="{{asset('js/app.js')}}"></script>

    @if (str_contains(Request::path(), 'admin'))
    <script src="{{asset('js/admin.js')}}"></script>
    @endif --}}
</body>
</html>
