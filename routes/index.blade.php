<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Bus - SOTRACO TRACK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Gestion des Bus</h1>

        <!-- Section pour les messages de session (succès, erreur) -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Section pour les erreurs de validation -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Oups !</strong> Il y a eu des problèmes avec votre saisie.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulaire d'ajout de bus -->
        <div class="card mb-4">
            <div class="card-header">
                Ajouter un nouveau bus
            </div>
            <div class="card-body">
                <form action="{{ route('admin.buses.store') }}" method="POST">
                    @csrf <!-- Protection CSRF obligatoire pour les formulaires Laravel -->
                    <div class="row">
                        <div class="col-md-3">
                            <label for="number" class="form-label">Numéro du bus</label>
                            <input type="text" class="form-control" id="number" name="number" value="{{ old('number') }}" required>
                        </div>
                        <div class="col-md-4">
                            <label for="line" class="form-label">Ligne</label>
                            <input type="text" class="form-control" id="line" name="line" value="{{ old('line') }}" placeholder="Ex: Ligne 12" required>
                        </div>
                        <div class="col-md-4">
                            <label for="destination" class="form-label">Destination</label>
                            <input type="text" class="form-control" id="destination" name="destination" value="{{ old('destination') }}" placeholder="Ex: Centre-ville" required>
                        </div>
                        <div class="col-md-1 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-100">Ajouter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Liste des bus existants -->
        <div class="card">
            <div class="card-header">
                Liste des bus
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Numéro</th>
                            <th>Ligne</th>
                            <th>Destination</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($buses as $bus)
                            <tr>
                                <td>{{ $bus->id }}</td>
                                <td><strong>{{ $bus->number }}</strong></td>
                                <td>{{ $bus->line }}</td>
                                <td>{{ $bus->destination }}</td>
                                <td class="text-end">
                                    <div class="d-flex justify-content-end">
                                        <a href="{{ route('admin.buses.edit', $bus->id) }}" class="btn btn-warning btn-sm me-2">Modifier</a>
                                        <form action="{{ route('admin.buses.destroy', $bus->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce bus ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Aucun bus enregistré pour le moment.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>