@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Nouveau Rendez-vous</h1>

        <form action="{{ route('rendezvous.store') }}" method="POST">
            @csrf

            <!-- Sélectionner un client -->
            <div class="form-group">
                <label for="client_id">Client</label>
                <select name="client_id" id="client_id" class="form-control" required>
                    <option value="" disabled selected>Choisissez un client</option>
                    @foreach ($clients as $client)
                        <option value="{{ $client->id }}">{{ $client->nom }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Nombre de personnes -->
            <div class="form-group">
                <label for="nombre_personnes">Nombre de personnes</label>
                <input type="number" class="form-control" id="nombre_personnes" name="nombre_personnes" min="1" required>
            </div>

            <!-- Plage horaire -->
            <div class="form-group">
                <label for="horaire">Plage horaire</label>
                <input type="text" class="form-control" id="horaire" name="horaire" placeholder="Exemple : 12h30-14h30" required>
            </div>


            <!-- Assigner des poneys -->
            <div class="form-group">
                <label for="poneys">Assigner des poneys</label>
                <div class="row">
                    @for ($i = 1; $i <= 5; $i++) <!-- Limiter à 5 poneys maximum -->
                    <div class="col-md-6">
                        <select name="poneys[]" class="form-control mb-2" required>
                            <option value="" disabled selected>Choisissez un poney</option>
                            @foreach ($poneys as $poney)
                                <option value="{{ $poney->id }}">{{ $poney->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                    @endfor
                </div>
            </div>

            <!-- Bouton de validation -->
            <button type="submit" class="btn btn-success mt-3">Créer le rendez-vous</button>
        </form>
    </div>
@endsection
