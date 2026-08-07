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
GPS
</h3>


<span class="status" id="gps-status">

@if($bus->is_tracking)

🟢 Actif

@else

🔴 Inactif

@endif

</span>


</div>



<div class="info-box">

<h3>
Dernière mise à jour
</h3>


<p id="update-time">

@if($bus->last_update)

{{ $bus->last_update }}

@else

Aucune

@endif


</p>


</div>



</div>








<div class="map-card">


<h2>
📍 Position du bus en temps réel
</h2>



<div id="map"></div>



</div>




</div>






<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>



<script>


let busId = {{ $bus->id }};



/*
 Position initiale
 Si le bus possède déjà une position
 on l'utilise
 Sinon Ouagadougou
*/


let latitude = {{ 
    $bus->latestLocation->latitude ?? 12.3714
}};


let longitude = {{ 
    $bus->latestLocation->longitude ?? -1.5197
}};




let map = L.map('map')

.setView(

[
latitude,
longitude
],

15

);





L.tileLayer(

'https://tile.openstreetmap.org/{z}/{x}/{y}.png',

{

attribution:'OpenStreetMap'

}

).addTo(map);





let busMarker = L.marker(

[
latitude,
longitude
],

{

title:"Bus {{ $bus->number }}"

}

)

.addTo(map)

.bindPopup(

"🚌 Bus {{ $bus->number }}"

)

.openPopup();







/*
 Actualisation automatique
 toutes les 3 secondes
*/


function updateBusPosition(){


fetch(
"/api/buses/"+busId+"/location"
)


.then(response => response.json())


.then(data => {



if(
data.latitude &&
data.longitude
){



let newPosition = [

data.latitude,

data.longitude

];



busMarker.setLatLng(
newPosition
);



map.panTo(
newPosition
);



document.getElementById(
"update-time"
).innerHTML =
data.last_update;



}



})

.catch(error=>{


console.log(
"Erreur GPS",
error
);


});


}





setInterval(

updateBusPosition,

3000

);






/*
 Afficher la position actuelle
 de l'utilisateur
*/


if(
navigator.geolocation
){



navigator.geolocation.getCurrentPosition(


function(position){



L.marker(

[

position.coords.latitude,

position.coords.longitude

]

)

.addTo(map)

.bindPopup(
"📍 Votre position"
);



},



function(){

console.log(
"GPS utilisateur refusé"
);

},



{

enableHighAccuracy:true

}



);



}





</script>



</body>

</html>