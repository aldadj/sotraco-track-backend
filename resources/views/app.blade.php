<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'SOTRACO TRACK')</title>

    {{-- On charge notre fichier CSS --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    {{-- On inclut l'en-tête --}}
    @include('partials.header')

    <main>
        {{-- Le contenu spécifique de chaque page viendra ici --}}
        @yield('content')
    </main>

    {{-- On inclut le pied de page --}}
    @include('partials.footer')

    {{-- On charge notre fichier JavaScript --}}
    <script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
