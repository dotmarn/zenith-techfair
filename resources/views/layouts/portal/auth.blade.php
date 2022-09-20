<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link href="/css/app.css" rel="stylesheet">
    <script src="/assets/js/font-awesome.js"></script>
    @livewireStyles
</head>
<body class="font-Poppins">
    @yield('content')
    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <x-livewire-alert::scripts />
    <x-livewire-alert::flash />
</body>
</html>
