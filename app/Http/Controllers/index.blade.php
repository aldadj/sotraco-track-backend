@extends('layouts.app')

@section('title', 'Carte en temps réel - SOTRACO TRACK')

@push('styles')
    {{-- On ajoute la feuille de style de Leaflet.js --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <style>
        #map {
            height: 80vh; /* Hauteur de la carte */
            width: 100%;
        }
        .bus-icon-label {
            text-align: center;
            font-weight: bold;
            color: white;
            background-color: rgba(0, 0, 0, 0.6);
            border-radius: 4px;
            padding: 2px 5px;
            font-size: 12px;
            white-space: nowrap;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid p-0">
        <div id="map"></div>
    </div>
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
                    iconSize: [40, 50],
                    iconAnchor: [20, 50] // pointe de l'icône
                });

                if (busMarkers[busId]) {
                    // Si le marqueur existe déjà, on met à jour sa position
                    busMarkers[busId].setLatLng(position);
                } else {
                    // Sinon, on crée un nouveau marqueur
                    busMarkers[busId] = L.marker(position, { icon: busIcon }).addTo(map);
                }

                // On ajoute une popup avec les détails du bus
                busMarkers[busId].bindPopup(
                    `<b>Bus ${bus.number}</b><br>Ligne: ${bus.line}<br>Destination: ${bus.destination}`
                );
            });
        }

        // Premier appel pour afficher les bus immédiatement
        fetchBusLocations();

        // On rafraîchit les positions toutes les 5 secondes
        setInterval(fetchBusLocations, 5000);
    </script>
@endpush
```

### 4. Ajout d'une icône de bus

Pour un meilleur rendu visuel, j'ai ajouté une icône de bus personnalisée. Créez le dossier `public/images` et placez-y une image nommée `bus-pin.png`. Vous pouvez utiliser n'importe quelle icône de votre choix.

### 5. Mise à jour du layout principal

Enfin, il faut modifier votre fichier `layouts/app.blade.php` pour qu'il puisse injecter les styles et scripts spécifiques à la page de la carte.

```diff
--- a/c:\Users\alisn\Desktop\SOTRACO_TRACK\backend\resources\views\layouts\app.blade.php
+++ b/c:\Users\alisn\Desktop\SOTRACO_TRACK\backend\resources\views\layouts\app.blade.php
@@ -7,6 +7,9 @@
 
     {{-- On charge notre fichier CSS --}}
     <link rel="stylesheet" href="{{ asset('css/style.css') }}">
+
+    {{-- Emplacement pour les styles additionnels des pages enfants --}}
+    @stack('styles')
 </head>
 <body>
 
@@ -21,5 +24,8 @@
 
     {{-- On charge notre fichier JavaScript --}}
     <script src="{{ asset('js/main.js') }}"></script>
+
+    {{-- Emplacement pour les scripts additionnels des pages enfants --}}
+    @stack('scripts')
 </body>
 </html>
```

Avec ces modifications, vous pouvez maintenant accéder à `http://votre-site.com/map` pour voir une carte avec la position de tous vos bus mise à jour en temps réel !

<!--
[PROMPT_SUGGESTION]Comment puis-je afficher l'itinéraire d'une ligne de bus spécifique sur la carte ?[/PROMPT_SUGGESTION]
[PROMPT_SUGGESTION]Comment sécuriser la section d'administration pour qu'elle ne soit accessible qu'après une connexion ?[/PROMPT_SUGGESTION]
-->
