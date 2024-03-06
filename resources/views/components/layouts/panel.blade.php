<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="robots" content="noindex, follow">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title . ' | ' . config('app.name') }}</title>
    <meta name="description" content="{{ $description ?? config('app.description') }}" />
    <meta name="Keywords"content="{{ $keywords ?? config('app.keywords') }}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <x-layouts.meta-information />
    @vite(['resources/css/app.css'])
    @stack('styles')
</head>

<body>
    <div class="flex h-screen bg-gray-50">
        <div class="flex flex-col flex-1 h-full">
            <x-panel.header />
            <main class="relative h-full overflow-y-auto flex">
                <x-panel.menu-bar.index />
                <div class="px-4 py-3 flex flex-col overflow-y-auto gap-y-3 transition-transform w-full">
                    <h2 class="text-xl font-semibold text-gray-700">
                        {{ $title }}
                    </h2>
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>
    @vite(['resources/js/app.js'])
    @stack('scripts')
</body>

</html>
