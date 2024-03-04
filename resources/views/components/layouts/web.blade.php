<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('assets/favicon.png') }}" type="image/png">
    <title>{{ request()->is('/') ? config('app.name') : $title . ' | ' . config('app.name') }}</title>
    @livewireStyles
    @vite('resources/css/app.css')
    @stack('styles')
</head>

<body>
    <x-web.header />
    {{ $slot }}
    @livewireScripts
    @vite('resources/js/app.js')
    @stack('scripts')
</body>

</html>
