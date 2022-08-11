<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    
    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    <!-- css local tailwind 1.0 -->
    <link href="{{ asset('css/tailwind.min.css') }}" rel="stylesheet">
    <script src="{{ asset('js/alpine.min.js') }}" defer></script>


</head>
<body class="bg-gray-100 h-screen antialiased leading-none font-sans">
    <div id="app">
        <header class="bg-blue-900 py-6">
            <div class="container mx-auto flex justify-between items-center px-6">
                <div>
                    <a href="{{ url('/') }}" class="text-lg font-semibold text-gray-100 no-underline">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                {{-- se agrego esta opcion de navegacion --}}
            @auth
                <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto">
                    <div class="text-sm lg:flex-grow ml-3">
                        <!--
                        <a href="{{ route("operaciones.index") }}" class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4" >
                            {{__("Operaciones")}}
                        </a>
                        
                        <a href="{{ route("cedis.index") }}" class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4" >
                            {{__("Cedis")}}
                        </a>

                        <a href="{{ route("detalleCedisOperaciones.index") }}" class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4" >
                            {{__("Asignar operaciones a cedis")}}
                        </a>

                        <a href="{{ route("choferes.index") }}" class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4" >
                            {{__("Choferes")}}
                        </a>

                        <a href="{{ route("asignaciones.index") }}" class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4" >
                            {{__("Asignaciones")}}
                        </a>

                        <a href="{{ route("estatusUnidades.index") }}" class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4" >
                            {{__("Estatus Unidades")}}
                        </a>

                        <a href="{{ route("rutas.index") }}" class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4" >
                            {{__("Rutas")}}
                        </a>

                        <a href="{{ route("paradas.index") }}" class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4" >
                            {{__("Paradas")}}
                        </a>

                        <a href="{{ route("motivoParadas.index") }}" class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4" >
                            {{__("Motivo paradas")}}
                        </a>

                        <a href="{{ route("eventos.index") }}" class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4" >
                            {{__("Eventos")}}
                        </a>

                        <a href="{{ route("justificaciones.index") }}" class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4" >
                            {{__("Justificaciones")}}
                        </a>-->

                        
                        </div>
                            <div class="hidden md:block">
                                <div class="ml-10 flex items-baseline space-x-4">
                                    <div x-data="{ dropdownOpen: false }" class="relative">
                                        <button @click="dropdownOpen = !dropdownOpen" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                                        Asignaciones
                                        </button>
                                        <div x-show="dropdownOpen" class="absolute right-0 mt-2 w-48 bg-white rounded-md overflow-hidden shadow-xl z-20">
                                            <a href="{{ route('asignaciones', ['id_operacion' => 1]) }}" class="block px-4 py-2 text-sm text-gray-800 border-b hover:bg-gray-200">{{ __('Pollo Vivo') }}</a>
                                            <a href="{{ route('asignaciones', ['id_operacion' => 2]) }}" class="block px-4 py-2 text-sm text-gray-800 border-b hover:bg-gray-200">{{ __('Pollo Procesado') }}</a>
                                        </div>
                                    </div>
                                    <a href="{{ route('tratarParadas') }}" class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4" >
                                    {{__("Paradas")}}
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>

            @endauth
            

                <nav class="space-x-4 text-gray-300 text-sm sm:text-base">
                    @guest
                        <a class="no-underline hover:underline" href="{{ route('login') }}">{{ __('Login') }}</a>
                        @if (Route::has('register'))
                            <a class="no-underline hover:underline" href="{{ route('register') }}">{{ __('Register') }}</a>
                        @endif
                    @else
                        <span>{{ Auth::user()->name }}</span>

                        <a href="{{ route('logout') }}"
                           class="no-underline hover:underline"
                           onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            {{ csrf_field() }}
                        </form>
                    @endguest
                </nav>
            </div>
        </header>

        @if(session("success"))
        <div class="bg-green-100 border border-blue-400 text-black-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Supervisor!</strong>
        <span class="block sm:inline">{{session("success")}}</span>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
            <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
        </span>
        </div>

        @endif

        @if(session("error"))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">{{__("Supervisor!")}}</strong>
        <span class="block sm:inline">{{session("error")}}</span>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
            <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
        </span>
        </div>
        @endif

        <div class="container mx-auto px-4">
        @yield('content')
        </div>
