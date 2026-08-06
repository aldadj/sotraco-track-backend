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
    </nav>
</header>