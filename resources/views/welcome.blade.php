<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SOTRACO TRACK</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            background: #f4f7f9;
            color: #333;
        }

        header {
            background: #00843D;
            color: white;
            padding: 20px 8%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 28px;
            font-weight: bold;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
            font-weight: bold;
        }


        .hero {
            padding: 70px 8%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 40px;
        }

        .hero-text {
            width: 50%;
        }

        .hero-text h1 {
            font-size: 45px;
            color: #00843D;
            margin-bottom: 20px;
        }

        .hero-text p {
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .buttons a {
            display: inline-block;
            padding: 14px 25px;
            border-radius: 8px;
            text-decoration: none;
            margin-right: 15px;
            font-weight: bold;
        }

        .primary {
            background: #00843D;
            color:white;
        }

        .secondary {
            background:#FCD116;
            color:#333;
        }


        .card {
            background:white;
            padding:30px;
            border-radius:15px;
            box-shadow:0 5px 20px rgba(0,0,0,0.1);
            width:350px;
        }

        .card h2 {
            color:#00843D;
            margin-bottom:20px;
        }


        input {
            width:100%;
            padding:12px;
            margin-bottom:15px;
            border:1px solid #ddd;
            border-radius:8px;
        }

        button {
            width:100%;
            padding:14px;
            background:#00843D;
            border:none;
            color:white;
            border-radius:8px;
            cursor:pointer;
            font-size:16px;
        }


        .features {
            padding:40px 8%;
            display:flex;
            justify-content:center;
            gap:30px;
        }

        .feature {
            background:white;
            padding:25px;
            border-radius:12px;
            width:300px;
            text-align:center;
        }

        .feature h3 {
            color:#00843D;
            margin-bottom:10px;
        }


        footer {
            background:#222;
            color:white;
            text-align:center;
            padding:20px;
            margin-top:40px;
        }


        @media(max-width:900px){

            .hero {
                flex-direction:column;
            }

            .hero-text {
                width:100%;
            }

            .features {
                flex-direction:column;
            }
        }

    </style>

</head>


<body>


<header>

    <div class="logo">
        🚌 SOTRACO TRACK
    </div>

    <nav>
        <a href="/">Accueil</a>
        <a href="/admin/buses">Administration</a>
    </nav>

</header>



<section class="hero">


<div class="hero-text">

<h1>
Suivez les bus SOTRACO en temps réel
</h1>


<p>
SOTRACO TRACK permet aux voyageurs de connaître
la position des bus, suivre leurs déplacements
et améliorer l'expérience de transport urbain à Ouagadougou.
</p>


<div class="buttons">

<a href="#" class="primary">
📍 Suivre un bus
</a>


<a href="/admin/buses" class="secondary">
⚙ Administration
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
Ajouter le bus
</button>


</form>


</div>


</section>




<section class="features">


<div class="feature">

<h3>
📍 Localisation GPS
</h3>

<p>
Visualisez la position exacte des bus.
</p>

</div>


<div class="feature">

<h3>
🚌 Gestion des bus
</h3>

<p>
Ajoutez et gérez facilement votre flotte.
</p>

</div>



<div class="feature">

<h3>
📱 Application mobile
</h3>

<p>
Connectée aux voyageurs en temps réel.
</p>

</div>


</section>




<footer>

© 2026 SOTRACO TRACK - Solution de suivi intelligent des transports

</footer>


</body>
</html>