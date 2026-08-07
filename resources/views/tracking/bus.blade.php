<!DOCTYPE html>
<html lang="fr">

<head>

<meta charset="UTF-8">

<title>
Suivi Bus {{ $bus->number }}
</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0">


<link rel="stylesheet" href="{{ asset('css/style.css') }}">

<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css">

</head>


<body>


<header class="tracking-header">


<a href="{{ route('home') }}" class="back-btn">
← Retour
</a>


<h1>
🚌 Suivi du Bus N° {{ $bus->number }}
</h1>


</header>




<div class="tracking-container">


<div class="bus-info">



<div class="info-box">

<h3>
Ligne
</h3>

<p>
{{ $bus->line }}
</p>

</div>




<div class="info-box">

<h3>
Destination
</h3>

<p>
{{ $bus->destination }}
</p>

</div>





<div class="info-box">

<h3>
Statut GPS
</h3>

<span class="status">

🟢 {{ $bus->status }}

</span>


</div>



</div>






<div class="map-card">


<h2>
📍 Position actuelle
</h2>


<div id="map"></div>


</div>


</div>






<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>


<script>


let latitude = {{ $bus->latitude ?? 12.3714 }};

let longitude = {{ $bus->longitude ?? -1.5197 }};



let map = L.map('map')
.setView(
[latitude,longitude],
14
);



L.tileLayer(

'https://tile.openstreetmap.org/{z}/{x}/{y}.png',

{
attribution:'OpenStreetMap'
}

).addTo(map);



L.marker(
[latitude,longitude]
)

.addTo(map)

.bindPopup(
"🚌 Bus {{ $bus->number }}"
)

.openPopup();



</script>


</body>

</html>