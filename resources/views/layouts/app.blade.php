<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @include('layouts.partials.styles')
    @stack('css')
</head>
<body class="flex">
    @if(auth()->check())
        @include('layouts.partials.sidebar')
    @endif
    <main class="w-full">
        @yield('content')
    </main>
     @stack('js')
</body>
</html>
