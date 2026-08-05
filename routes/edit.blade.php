<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le Bus - SOTRACO TRACK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Modifier le Bus #{{ $bus->number }}</h1>
            <a href="{{ route('admin.buses.index') }}" class="btn btn-secondary">Retour à la liste</a>
        </div>

        <!-- Formulaire de modification de bus -->
        <div class="card">
            <div class="card-header">
                Informations du bus
            </div>
            <div class="card-body">
                <form action="{{ route('admin.buses.update', $bus->id) }}" method="POST">
                    @csrf <!-- Protection CSRF -->
                    @method('PUT') <!-- Méthode HTTP pour la mise à jour -->

                    <div class="mb-3">
                        <label for="number" class="form-label">Numéro du bus</label>
                        <input type="text" class="form-control" id="number" name="number" value="{{ old('number', $bus->number) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="line" class="form-label">Ligne</label>
                        <input type="text" class="form-control" id="line" name="line" value="{{ old('line', $bus->line) }}" placeholder="Ex: Ligne 12" required>
                    </div>

                    <div class="mb-3">
                        <label for="destination" class="form-label">Destination</label>
                        <input type="text" class="form-control" id="destination" name="destination" value="{{ old('destination', $bus->destination) }}" placeholder="Ex: Centre-ville" required>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>