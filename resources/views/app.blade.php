<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Icons -->
        <link rel="icon" href="{{ Vite::asset('resources/assets/img/favicon.ico') }}" type="image/x-icon" />
        <link rel="apple-touch-icon" sizes="180x180" href="{{ Vite::asset('resources/assets/apple-touch-icon.png') }}" />
        <link rel="icon" type="image/png" sizes="32x32" href="{{ Vite::asset('resources/assets/favicon-32x32.png') }}" />
        <link rel="icon" type="image/png" sizes="16x16" href="{{ Vite::asset('resources/assets/favicon-16x16.png') }}" />
        <link rel="manifest" href="{{ Vite::asset('resources/assets/site.webmanifest') }}" />
        <meta name="theme-color" content="#ffffff" />

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.ts', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @inertia
    </body>
</html>
