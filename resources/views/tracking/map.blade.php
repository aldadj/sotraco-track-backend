@extends('layouts.app')

@section('title', 'Carte de suivi en temps réel')

@push('styles')
    {{-- On ajoute la feuille de style de Leaflet.js --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <style>
        #map {
            height: 85vh; /* Hauteur de la carte */
            width: 100%;
        }
        .bus-icon-label {
            text-align: center;
            font-weight: bold;
            color: white;
            background-color: rgba(0, 0, 0, 0.7);
            border-radius: 4px;
            padding: 2px 5px;
            font-size: 12px;
            white-space: nowrap;
            transform: translateX(-50%);
            left: 50%;
            position: relative;
            top: -5px;
        }
    </style>
@endpush

@section('content')
    <div id="map"></div>
@endsection

@push('scripts')
    {{-- On ajoute le script de Leaflet.js --}}
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <script>
        // Initialisation de la carte, centrée sur Ouagadougou
        const map = L.map('map').setView([12.3714, -1.5197], 13);

        // Ajout du fond de carte OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Un objet pour stocker les marqueurs des bus, avec l'ID du bus comme clé
        let busMarkers = {};

        // Fonction pour récupérer les positions et mettre à jour la carte
        async function fetchBusLocations() {
            try {
                // On appelle l'endpoint de l'API qui retourne les positions de tous les bus
                const response = await fetch("{{ url('/api/tracking/buses') }}");
                if (!response.ok) {
                    console.error("Erreur lors de la récupération des données des bus.");
                    return;
                }
                const data = await response.json();
                const locations = data.data;

                // Mettre à jour les marqueurs sur la carte
                updateMarkers(locations);

            } catch (error) {
                console.error("Exception lors de l'appel à l'API:", error);
            }
        }

        function updateMarkers(locations) {
            locations.forEach(bus => {
                const busId = bus.bus_id;
                const position = [bus.latitude, bus.longitude];

                // Création de l'icône personnalisée avec le numéro du bus
                const busIcon = L.divIcon({
                    html: `<div>
                               <img src="{{ asset('images/bus-pin.png') }}" style="width: 35px; height: 35px;" />
                               <div class="bus-icon-label">Bus ${bus.number}</div>
                           </div>`,
                    className: '', // pas de classe de conteneur par défaut
                    iconSize: [35, 50],
                    iconAnchor: [17, 50] // pointe de l'icône
                });

                if (busMarkers[busId]) {
                    busMarkers[busId].setLatLng(position); // On met à jour la position
                } else {
                    busMarkers[busId] = L.marker(position, { icon: busIcon }).addTo(map); // On crée le marqueur
                }

                busMarkers[busId].bindPopup(
                    `<b>Bus ${bus.number}</b><br>Ligne: ${bus.line}<br>Destination: ${bus.destination}`
                );
            });
        }

        fetchBusLocations(); // Premier appel
        setInterval(fetchBusLocations, 5000); // Rafraîchissement toutes les 5 secondes
    </script>
@endpush