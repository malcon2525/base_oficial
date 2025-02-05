<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Minha Aplicação')</title>
    
   
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/css/adm.css', 'resources/js/app.js'])
</head>
<body>
    
    {{-- menu topo --}}
    @include('layouts.app.adm.menu-topo')

    {{-- menu lateral esquerdo --}}
    @include('layouts.app.adm.menu-lateral')
    
    
    {{-- CONTEÚDO --}}

    <div id="app">
        @yield('content')
    </div>
    
    
    
    <!-- CSS e Scripts específicos da página -->
    @stack('styles')
    @stack('scripts')
</body>
</html>
