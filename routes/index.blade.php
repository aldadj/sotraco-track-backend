@extends('layouts.app')

@section('title', 'Gestion des Bus')

@push('styles')
<style>
    .admin-container {
        padding: 40px 8%;
    }
    .table-container {
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        margin-bottom: 40px;
        overflow-x: auto;
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        padding: 12px 15px;
        border-bottom: 1px solid #ddd;
        text-align: left;
    }
    th {
        background-color: #f2f2f2;
    }
    .actions {
        display: flex;
        gap: 10px;
    }
    .actions a, .actions button {
        text-decoration: none;
        font-size: 14px;
        background: none;
        border: none;
        cursor: pointer;
        padding: 8px 12px;
        border-radius: 5px;
        color: white;
    }
    .edit-btn { background-color: #FCD116; color: #333; }
    .delete-btn { background-color: #EF4444; }
    .actions form {
        display: inline-block;
        margin: 0;
    }
    .form-container {
        background: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    .form-container h2 {
        margin-bottom: 20px;
        color: #00843D;
    }
    .alert-success {
        background-color: #D1FAE5;
        color: #065F46;
        padding: 15px;
        border-radius: 5px;
        margin-bottom: 20px;
    }
</style>
@endpush

@section('content')
<div class="admin-container">

    <h1>Gestion des Bus</h1>
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
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($buses as $bus)
                    <tr>
                        <td>{{ $bus->number }}</td>
                        <td>{{ $bus->line }}</td>
                        <td>{{ $bus->destination }}</td>
                        <td class="actions">
                            <a href="{{ route('admin.buses.edit', $bus) }}" class="edit-btn">Modifier</a>
                            <form action="{{ route('admin.buses.destroy', $bus) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce bus ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-btn">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="text-align: center;">Aucun bus trouvé.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="form-container card">
        <h2>Ajouter un nouveau bus</h2>
        <form action="{{ route('admin.buses.store') }}" method="POST">
            @csrf
            <input type="text" name="number" placeholder="Numéro du bus" required value="{{ old('number') }}">
            <input type="text" name="line" placeholder="Ligne" required value="{{ old('line') }}">
            <input type="text" name="destination" placeholder="Destination" required value="{{ old('destination') }}">
            <button type="submit">Ajouter le bus</button>
        </form>
    </div>
</div>
@endsection