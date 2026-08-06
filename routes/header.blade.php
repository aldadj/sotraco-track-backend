<header>
    <div class="logo">
        🚌 SOTRACO TRACK
    </div>

    <div class="menu-btn" onclick="toggleMenu()">
        ☰
    </div>

    <nav id="menu">
        <a href="{{ route('home') }}">
            Accueil
        </a>
        <a href="{{ route('admin.buses.index') }}">
            Administration
        </a>
        <a href="{{ route('tracking.map') }}">
            Suivi en direct
        </a>

        {{-- Liens d'authentification --}}
        @auth
            {{-- Si l'utilisateur est connecté --}}
            <span class="user-name">Bonjour, {{ Auth::user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); this.closest('form').submit();"
                   class="logout-btn">
                    Déconnexion
                </a>
            </form>
        @else
            {{-- Si l'utilisateur n'est pas connecté --}}
            <a href="{{ route('login') }}">Connexion</a>
            <a href="{{ route('register') }}">Inscription</a>
        @endauth
    </nav>
</header>
