<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Titre dynamique, avec une valeur par défaut --}}
    <title>@yield('title', 'SOTRACO TRACK')</title>

    {{-- Fichiers CSS globaux --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    {{-- Emplacement pour les styles spécifiques à une page --}}
    @stack('styles')
</head>
<body>
    {{-- Inclusion de l'en-tête (navbar) --}}
    @include('partials.header')

    <main>
        {{-- Le contenu principal de la page sera injecté ici --}}
        @yield('content')
    </main>

    {{-- Inclusion du pied de page --}}
    @include('partials.footer')

    {{-- Fichiers JavaScript globaux --}}
    <script src="{{ asset('js/main.js') }}"></script>
    {{-- Emplacement pour les scripts spécifiques à une page --}}
    @stack('scripts')
</body>
</html>
