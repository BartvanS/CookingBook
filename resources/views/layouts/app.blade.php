<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ documentTitle($title) }}</title>
    <x-favicon icon="🍳"/>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @livewireStyles

    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.6.0/dist/alpine.js" defer></script>
</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-100">
    @include('navigation-dropdown')

    {{ Diglactic\Breadcrumbs\Breadcrumbs::render(Route::currentRouteName(), ...array_values(request()->route()->parameters())) }}

    <main id="app">
        {{ $slot }}
    </main>
</div>

@stack('modals')

@livewireScripts
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>

