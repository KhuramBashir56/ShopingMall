<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="robots" content="index, follow">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ request()->is('/') ? config('app.name') : $title . ' | ' . config('app.name') }}</title>
    <meta name="description" content="{{ $description ?? config('app.description') }}" />
    <meta name="Keywords"content="{{ $keywords ?? config('app.keywords') }}" />
    <x-layouts.meta-information />
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
