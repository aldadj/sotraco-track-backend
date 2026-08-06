@extends('layouts.app')

@section('title', 'Accueil - Suivi des bus en temps réel')

@section('content')
<section class="hero">
    <div class="hero-text">
        <h1>
            Suivez les bus SOTRACO en temps réel
        </h1>
        <p>
            Une plateforme intelligente permettant aux voyageurs
            de localiser les bus, connaître leurs déplacements
            et améliorer le transport urbain à Ouagadougou.
        </p>
        <div class="buttons">
            <a class="btn primary" href="{{ route('tracking.map') }}">
                📍 Voir les bus
            </a>
            <a class="btn secondary" href="{{ route('admin.buses.index') }}">
                ⚙ Gestion
            </a>
        </div>
    </div>
    <div class="card">
        <h2>
            Ajouter un bus
        </h2>
        <form method="POST" action="{{ route('admin.buses.store') }}">
            @csrf
            <input type="text" name="number" placeholder="Numéro du bus" required>
            <input type="text" name="line" placeholder="Ligne (Ex: Ligne 12)" required>
            <input type="text" name="destination" placeholder="Destination (Ex: Centre-ville)" required>
            <button type="submit">
                Ajouter
            </button>
        </form>
    </div>
</section>

<section class="features">
    <div class="feature">
        <h3>📍 GPS Temps réel</h3>
        <p>Position des bus en direct sur une carte.</p>
    </div>
    <div class="feature">
        <h3>🚌 Gestion flotte</h3>
        <p>Administration simple des véhicules.</p>
    </div>
    <div class="feature">
        <h3>📱 Mobile Ready</h3>
        <p>Accessible depuis smartphone et ordinateur.</p>
    </div>
</section>
@endsection