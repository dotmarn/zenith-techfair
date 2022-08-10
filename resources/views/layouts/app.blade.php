<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link href="/css/app.css" rel="stylesheet">
    @livewireStyles
</head>
<body class="bg-red-600">
    @yield('content')
    @livewireScripts
</body>
</html>
