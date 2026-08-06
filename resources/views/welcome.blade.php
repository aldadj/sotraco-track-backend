<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>SOTRACO TRACK</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI', Arial, sans-serif;
}


body{
    background:#f5f7f9;
    color:#333;
}


/* HEADER */

header{

    background:#00843D;
    color:white;

    padding:15px 8%;

    display:flex;
    justify-content:space-between;
    align-items:center;

}


.logo{

    font-size:25px;
    font-weight:700;

}


nav{

    display:flex;
    gap:25px;

}


nav a{

    color:white;
    text-decoration:none;
    font-weight:600;

}


.menu-btn{

    display:none;
    font-size:30px;
    cursor:pointer;

}



/* HERO */

.hero{

    min-height:80vh;

    padding:60px 8%;

    display:flex;

    justify-content:space-between;

    align-items:center;

    gap:40px;

}



.hero-text{

    flex:1;

}



.hero-text h1{

    font-size:clamp(32px,5vw,55px);

    color:#00843D;

    line-height:1.2;

    margin-bottom:20px;

}



.hero-text p{

    font-size:18px;

    line-height:1.6;

    margin-bottom:30px;

}



.buttons{

    display:flex;

    flex-wrap:wrap;

    gap:15px;

}



.btn{

    padding:15px 25px;

    border-radius:30px;

    text-decoration:none;

    font-weight:bold;

    display:inline-block;

}



.primary{

    background:#00843D;

    color:white;

}


.secondary{

    background:#FCD116;

    color:#333;

}





/* FORMULAIRE */


.card{

    flex:0 0 380px;

    background:white;

    padding:30px;

    border-radius:20px;

    box-shadow:0 10px 30px rgba(0,0,0,.1);

}


.card h2{

    color:#00843D;

    margin-bottom:20px;

}



input{

    width:100%;

    padding:14px;

    margin-bottom:15px;

    border-radius:10px;

    border:1px solid #ddd;

    font-size:15px;

}



button{

    width:100%;

    padding:15px;

    border:none;

    border-radius:10px;

    background:#00843D;

    color:white;

    font-size:16px;

    cursor:pointer;

}




/* FEATURES */


.features{

    padding:50px 8%;

    display:grid;

    grid-template-columns:repeat(3,1fr);

    gap:25px;

}



.feature{

    background:white;

    padding:30px;

    border-radius:20px;

    text-align:center;

    box-shadow:0 5px 15px rgba(0,0,0,.08);

}


.feature h3{

    color:#00843D;

    margin-bottom:15px;

}





/* FOOTER */


footer{

    background:#222;

    color:white;

    padding:25px;

    text-align:center;

}







/* TABLET */

@media(max-width:900px){


.hero{

    flex-direction:column;

    text-align:center;

}


.card{

    width:100%;

    max-width:500px;

}



.buttons{

    justify-content:center;

}


.features{

    grid-template-columns:1fr;

}


}





/* MOBILE */


@media(max-width:600px){


header{

    padding:15px 5%;

}


.logo{

    font-size:20px;

}



nav{

    display:none;

    position:absolute;

    top:65px;

    left:0;

    width:100%;

    background:#00843D;

    flex-direction:column;

    text-align:center;

    padding:20px;

}


nav.active{

    display:flex;

}


.menu-btn{

    display:block;

}



.hero{

    padding:40px 5%;

}


.hero-text p{

    font-size:16px;

}



.btn{

    width:100%;

    text-align:center;

}


.card{

    padding:20px;

}



.features{

    padding:30px 5%;

}


.feature{

    padding:20px;

}



footer{

    font-size:14px;

}


}


</style>

</head>


<body>



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


<a class="btn primary" href="{{ route('map.index') }}">
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


<form method="POST" action="/admin/buses">

@csrf


<input 
type="text"
name="number"
placeholder="Numéro du bus">


<input
type="text"
name="name"
placeholder="Nom du trajet">


<input
type="text"
name="plate_number"
placeholder="Immatriculation">


<button>
Ajouter
</button>


</form>


</div>



</section>






<section class="features">


<div class="feature">

<h3>
📍 GPS Temps réel
</h3>

<p>
Position des bus en direct sur une carte.
</p>

</div>



<div class="feature">

<h3>
🚌 Gestion flotte
</h3>

<p>
Administration simple des véhicules.
</p>

</div>



<div class="feature">

<h3>
📱 Mobile Ready
</h3>

<p>
Accessible depuis smartphone et ordinateur.
</p>

</div>


</section>




<footer>

SOTRACO TRACK © 2026  
<br>
La mobilité intelligente du Burkina Faso 🇧🇫

</footer>




<script>

function toggleMenu(){

document.getElementById("menu")
.classList.toggle("active");

}

</script>



</body>

</html>