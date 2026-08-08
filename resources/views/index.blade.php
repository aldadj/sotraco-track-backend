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
            de localiser les bus, suivre leurs déplacements
            et améliorer le transport urbain à Ouagadougou.
        </p>



        <div class="buttons">


            <a class="btn primary" href="#bus">

                📍 Voir les bus

            </a>



            <a class="btn secondary" href="{{ route('admin.buses.index') }}">

                ⚙ Gestion

            </a>


        </div>


    </div>



</section>







<section id="bus" class="bus-section">


<h2>
    <img
    src="{{ asset('images/sotraco-bus.png') }}"
    alt="SOTRACO">Bus disponibles
</h2>




<div class="bus-container">



@if(isset($buses) && count($buses) > 0)



@foreach($buses as $bus)



<div class="bus-card">



<div class="bus-icon">
    <img
    src="{{ asset('images/sotraco-bus.png') }}"
    alt="SOTRACO"
>
</div>




<h3>

Bus N° {{ $bus->number }}

</h3>



<p>

<strong>Ligne :</strong>

{{ $bus->line }}

</p>




<p>

<strong>Destination :</strong>

{{ $bus->destination }}

</p>






@if($bus->is_tracking)


<div class="online">

🟢 Suivi GPS actif

</div>




<a class="follow-btn"
href="{{ route('tracking.bus',$bus->id) }}">


📍 Suivre ce bus


</a>




@else


<div class="offline">

🔴 GPS indisponible

</div>




<button disabled>

Non disponible

</button>



@endif




</div>



@endforeach



@else



<p>

Aucun bus disponible actuellement.

</p>



@endif





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


@endsection