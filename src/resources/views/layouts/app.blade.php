<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    @vite(['resources/js/app.js'])
    @laravelTelInputStyles
    @livewireStyles
    @yield('styles')
</head>
<body class="font-Poppins">
    @yield('content')
    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <x-livewire-alert::scripts />
    <x-livewire-alert::flash />
    @yield('scripts')
    @laravelTelInputScripts
</body>
</html>
