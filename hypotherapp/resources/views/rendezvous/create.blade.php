@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-5">Créer un Nouveau Rendez-vous</h1>

        <form action="{{ route('rendezvous.store') }}" method="POST" class="shadow p-4 rounded bg-light">
            @csrf

            <!-- Sélectionner un client -->
            <div class="form-group mb-4">
                <label for="client_id" class="form-label"><i class="fas fa-user"></i> Sélectionner un client</label>
                <select name="client_id" id="client_id" class="form-control" required>
                    <option value="" disabled selected>Choisissez un client</option>
                    @foreach ($clients as $client)
                        <option value="{{ $client->id }}">{{ $client->nom }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Nombre de personnes -->
            <div class="form-group mb-4">
                <label for="nombre_personnes" class="form-label"><i class="fas fa-users"></i> Nombre de personnes</label>
                <input type="number" class="form-control" id="nombre_personnes" name="nombre_personnes" min="1" placeholder="Ex : 3" required>
            </div>

            <!-- Plage horaire -->
            <div class="form-group mb-4">
                <label for="horaire" class="form-label"><i class="fas fa-clock"></i> Plage horaire</label>
                <input type="text" class="form-control" id="horaire" name="horaire" placeholder="Exemple : 12h30-14h30" required>
            </div>

            <!-- Assigner des poneys -->
            <div class="form-group mb-4">
                <label for="poneys" class="form-label"><i class="fas fa-horse"></i> Assigner des poneys</label>
                <div class="row">
                    @for ($i = 1; $i <= 5; $i++) <!-- Limiter à 5 poneys maximum -->
                    <div class="col-md-6">
                        <select name="poneys[]" class="form-control mb-3" required>
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
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-success px-5 py-2">
                    <i class="fas fa-calendar-plus"></i> Créer le rendez-vous
                </button>
            </div>
        </form>
    </div>

    <!-- Styles supplémentaires -->
    <style>
        .form-group label {
            font-weight: bold;
        }
        .form-control:focus {
            border-color: #28a745;
            box-shadow: 0 0 5px rgba(40, 167, 69, 0.8);
        }
        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }
    </style>
@endsection
