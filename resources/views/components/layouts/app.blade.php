<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'SrikandiMarch' }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="bg-slate-200 white:bg-slate-700">
        <div class="min-h-screen flex flex-col">

            @livewire('partials.navbar')

            <main class="flex-grow">
                {{ $slot }}
            </main>

            @livewire('partials.footer')

        </div>
        @livewireScripts
    </body>
</html>
