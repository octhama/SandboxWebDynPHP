@extends('layouts.app')

@section('content')
    <h1><Modifier le Client : {{ $client->nom }}</h1>

    <form action="{{ route('clients.update', $client->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" name="nom" class="form-control" value="{{ $client->nom }}" required>
        </div>
        <div class="mb-3">
            <label for="nombre_personnes" class="form-label">Nombre de personnes</label>
            <input type="number" name="nombre_personnes" class="form-control" value="{{ $client->nombre_personnes }}" required>
        </div>
        <div class="mb-3">
            <label for="heures" class="form-label">Heures</label>
            <input type="number" name="heures" class="form-control" value="{{ $client->heures }}" required>
        </div>
        <div class="mb-3">
            <label for="prix" class="form-label">Prix</label>
            <input type="number" name="prix" class="form-control" value="{{ $client->prix }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Sauvegarder</button>
        <a href="{{ route('clients.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
@endsection

