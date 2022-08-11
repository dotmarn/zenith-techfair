<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link href="/css/app.css" rel="stylesheet">
    <script src="/assets/js/font-awesome.js"></script>
    @livewireStyles
    @yield('styles')
</head>
<body class="font-Poppins">
    @yield('content')
    @livewireScripts
    @yield('scripts')
</body>
</html>
