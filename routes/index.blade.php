@extends('layouts.app')

@section('title', 'Gestion des Bus')

@push('styles')
<style>

.admin-container {
    padding:40px 8%;
}


/* TABLEAU */

.table-container {

    background:white;
    padding:20px;
    border-radius:15px;
    box-shadow:0 5px 15px rgba(0,0,0,.1);
    margin-bottom:40px;
    overflow-x:auto;

}


table {

    width:100%;
    border-collapse:collapse;

}


th, td {

    padding:15px;
    border-bottom:1px solid #ddd;
    text-align:center;

}


th {

    background:#00843D;
    color:white;

}



/* STATUS GPS */

.gps-active {

    color:#00843D;
    font-weight:bold;

}


.gps-off {

    color:#EF4444;
    font-weight:bold;

}



/* ACTIONS */

.actions {

    display:flex;
    justify-content:center;
    gap:10px;
    flex-wrap:wrap;

}


.actions a,
.actions button {

    text-decoration:none;
    border:none;
    cursor:pointer;
    padding:10px 15px;
    border-radius:8px;
    font-size:14px;
    color:white;

}



.edit-btn {

    background:#FCD116;
    color:#333 !important;

}


.delete-btn {

    background:#EF4444;

}


.gps-btn {

    background:#00843D;

}


.gps-stop {

    background:#555;

}



.actions form {

    margin:0;

}



/* FORMULAIRE */

.form-container {

    background:white;
    padding:30px;
    border-radius:15px;
    box-shadow:0 5px 15px rgba(0,0,0,.1);

}


.form-container h2 {

    color:#00843D;
    margin-bottom:20px;

}



input {

    width:100%;
    padding:14px;
    margin-bottom:15px;
    border-radius:10px;
    border:1px solid #ddd;

}


button[type="submit"] {

    background:#00843D;
    color:white;
    padding:14px;
    border:none;
    border-radius:10px;
    cursor:pointer;

}



.alert-success {

    background:#D1FAE5;
    color:#065F46;
    padding:15px;
    border-radius:8px;
    margin-bottom:20px;

}



</style>
@endpush



@section('content')


<div class="admin-container">


<h1> Gestion des Bus</h1>


<br>



@if(session('success'))

<div class="alert-success">

{{ session('success') }}

</div>

@endif




<div class="table-container">


<h2>Liste des bus</h2>


<table>


<thead>

<tr>

<th>Numéro</th>

<th>Ligne</th>

<th>Destination</th>

<th>GPS</th>

<th>Actions</th>


</tr>


</thead>



<tbody>


@forelse($buses as $bus)


<tr>


<td>

{{ $bus->number }}

</td>



<td>

{{ $bus->line }}

</td>



<td>

{{ $bus->destination }}

</td>



<td>


@if($bus->is_tracking)


<span class="gps-active">

🟢 Actif

</span>


@else


<span class="gps-off">

🔴 Désactivé

</span>


@endif


</td>




<td>


<div class="actions">



<a href="{{ route('admin.buses.edit',$bus) }}"
class="edit-btn">

✏ Modifier

</a>






<form action="{{ route('admin.buses.destroy',$bus) }}"
method="POST"
onsubmit="return confirm('Supprimer ce bus ?');">


@csrf

@method('DELETE')


<button class="delete-btn">

🗑 Supprimer

</button>


</form>






<form action="{{ route('admin.buses.tracking',$bus) }}"
method="POST">


@csrf

@method('PATCH')


@foreach($buses as $bus)

<div class="bus-card">

    <h1 class="tracking-title">
        <img
            src="{{ asset('images/sotraco-bus.png') }}"
            alt="SOTRACO"
        >
    
        Suivi du Bus N° {{ $bus->number }}
    </h1>


<p>
Ligne : {{ $bus->line }}
</p>


<p>
Destination : {{ $bus->destination }}
</p>


@if($bus->is_tracking)

<p class="online">
🟢 GPS actif
</p>

<a href="{{ route('tracking.map') }}">
📍 Suivre en direct
</a>


@else

<p class="pause">
🟡 En pause
</p>

<a href="#">
ℹ Voir les informations
</a>


@endif


</div>


@endforeach



</form>




</div>


</td>



</tr>



@empty


<tr>

<td colspan="5">

Aucun bus trouvé.

</td>


</tr>



@endforelse


</tbody>



</table>



</div>






<div class="form-container card">


<h2>

Ajouter un nouveau bus

</h2>



<form action="{{ route('admin.buses.store') }}"
method="POST">


@csrf



<input 
type="text"
name="number"
placeholder="Numéro du bus"
value="{{ old('number') }}"
required>



<input 
type="text"
name="line"
placeholder="Ligne"
value="{{ old('line') }}"
required>




<input 
type="text"
name="destination"
placeholder="Destination"
value="{{ old('destination') }}"
required>




<button type="submit">

Ajouter le bus

</button>



</form>



</div>



</div>


@endsection