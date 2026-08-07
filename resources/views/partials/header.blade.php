<header>

    <div class="logo">
    🚌 SOTRACO TRACK
    </div>
    
    
    <div class="menu-btn" onclick="toggleMenu()">
        ☰
    </div>
    
    
    <nav id="menu">
    
    <a href="{{ url('/') }}">
    Accueil
    </a>
    
    
    <a href="{{ route('admin.buses.index') }}">
    Administration
    </a>
    
    
    <a href="{{ route('map.index') }}">
    Suivi GPS
    </a>
    
    
    </nav>
    
    </header>