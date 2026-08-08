<header>

    <a href="{{ route('home') }}" class="logo">
        <img src="{{ asset('images/sotraco-logo.png') }}" alt="SOTRACO">
    </a>
    
    
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