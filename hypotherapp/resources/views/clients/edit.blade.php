@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Modifier le client : <strong>{{ $client->nom }}</strong></h1>

        <!-- Affichage des erreurs -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li><i class="fas fa-exclamation-circle"></i> {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulaire de modification -->
        <form action="{{ route('clients.update', $client->id) }}" method="POST" class="p-4 shadow-sm bg-light rounded">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label for="nom" class="form-label">Nom du client</label>
                <input type="text" class="form-control @error('nom') is-invalid @enderror" id="nom" name="nom" value="{{ old('nom', $client->nom) }}" required>
                @error('nom')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="nombre_personnes" class="form-label">Nombre de personnes</label>
                <input type="number" class="form-control @error('nombre_personnes') is-invalid @enderror" id="nombre_personnes" name="nombre_personnes" value="{{ old('nombre_personnes', $client->nombre_personnes) }}" min="1" required>
                @error('nombre_personnes')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="heures" class="form-label">Heures</label>
                <input type="number" class="form-control @error('heures') is-invalid @enderror" id="heures" name="heures" value="{{ old('heures', $client->heures) }}" min="0" max="6" required>
                @error('heures')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-4">
                <label for="prix_total" class="form-label">Prix total (€)</label>
                <input type="number" class="form-control @error('prix_total') is-invalid @enderror" id="prix_total" name="prix_total" value="{{ old('prix_total', $client->prix_total) }}" min="0" step="0.01" required>
                @error('prix_total')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Boutons d'action -->
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Mettre à jour
                </button>
                <a href="{{ route('clients.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Annuler
                </a>
            </div>
        </form>
    </div>

    <!-- Ajout de styles CSS -->
    <style>
        /* Arrière-plan */
        body {
            background-color: #f8f9fa; /* Blanc cassé */
            font-family: 'Poppins', sans-serif;
            color: #2c3e50; /* Gris foncé */
        }
        .form-control.is-invalid {
            border-color: #dc3545;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
        }
        .form-label {
            font-weight: bold;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
        .btn-secondary:hover {
            background-color: #6c757d;
            border-color: #5a6268;
        }
    </style>
@endsection
