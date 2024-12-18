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
    <div class="container">
        
        <div class="d-flex mb-3">
            <div class="logo align-self-center me-3">
                Manager On-click
            </div>
            <div class=" lign-self-center me-3">
                <a class="" data-bs-toggle="offcanvas" href="#menuLateralADM" role="button" aria-controls="offcanvasExample">
                    <svg class="sanduiche" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-justify" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M2 12.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5m0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5m0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5m0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5"/>
                    </svg>
                </a>
            </div>
            <div class="menu-topo flex-fill text-end align-self-center">
                menu
            </div>
        </div>
    </div>


    {{-- menu lateral esquerdo --}}
    @include('layouts.app.adm.menuadm')
    
    
    
    
    {{-- CONTEÚDO --}}
    @yield('content')

    
</body>
</html>
