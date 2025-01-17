@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Modifier le client : {{ $client->nom }}</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('clients.update', $client->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nom">Nom du client</label>
                <input type="text" class="form-control" id="nom" name="nom" value="{{ $client->nom }}" required>
            </div>

            <div class="form-group">
                <label for="nombre_personnes">Nombre de personnes</label>
                <input type="number" class="form-control" id="nombre_personnes" name="nombre_personnes" value="{{ $client->nombre_personnes }}" required>
            </div>

            <div class="form-group">
                <label for="heures">Heures</label>
                <input type="number" class="form-control" id="heures" name="heures" value="{{ $client->heures }}" required>
            </div>

            <div class="form-group">
                <label for="prix_total">Prix total</label>
                <input type="number" class="form-control" id="prix_total" name="prix_total" value="{{ $client->prix_total }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Mettre à jour</button>
            <a href="{{ route('clients.index') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
@endsection
