<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="shortcut icon" type="image/jpg" href=""/>
    <link href="/css/app.css" rel="stylesheet">
    <script src="/assets/js/font-awesome.js"></script>
    <script src="/assets/js/alpine.min.js" defer></script>
    @yield('styles')
    @livewireStyles
</head>

<body class="bg-gray-200 font-Poppins">
    <div>
        <div x-data="{ sidebarOpen: false }">
            <div class="flex h-screen font-Lato">
                <div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false" class="fixed z-20 inset-0 bg-black opacity-50 transition-opacity lg:hidden"></div>

                @include('partials.sidebar')

                <div class="flex-1 flex flex-col overflow-hidden">
                    @include('partials.navbar')
                    <main class="flex-1 overflow-x-hidden overflow-y-auto">
                        @yield('content')
                    </main>
                </div>
            </div>
        </div>
    </div>
    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <x-livewire-alert::scripts />
    <x-livewire-alert::flash />
    @yield('javascripts')
</body>
</html>
