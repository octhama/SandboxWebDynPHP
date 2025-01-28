@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-5">Créer un Nouveau Rendez-vous</h1>

        <form action="{{ route('rendezvous.store') }}" method="POST" class="shadow p-4 rounded bg-light">
            @csrf

            <!-- Sélectionner un client -->
            <div class="form-group mb-4">
                <label for="client_id" class="form-label"><i class="fas fa-user"></i> Sélectionner un client</label>
                <select name="client_id" id="client_id" class="form-control @error('client_id') is-invalid @enderror" required>
                    <option value="" disabled selected>Choisissez un client</option>
                    @foreach ($clients as $client)
                        <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>{{ $client->nom }}</option>
                    @endforeach
                </select>
                @error('client_id')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <!-- Nombre de personnes -->
            <div class="form-group mb-4">
                <label for="nombre_personnes" class="form-label"><i class="fas fa-users"></i> Nombre de personnes</label>
                <input type="number" class="form-control @error('nombre_personnes') is-invalid @enderror" id="nombre_personnes" name="nombre_personnes" min="1" value="{{ old('nombre_personnes') }}" placeholder="Ex : 3" required>
                @error('nombre_personnes')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <!-- Plage horaire -->
            <div class="form-group mb-4">
                <label for="horaire" class="form-label"><i class="fas fa-clock"></i> Plage horaire</label>
                <input type="text" class="form-control @error('horaire') is-invalid @enderror" id="horaire" name="horaire" value="{{ old('horaire') }}" placeholder="Exemple : 12h30-14h30" required>
                @error('horaire')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <!-- Assigner des poneys -->
            <div class="form-group mb-4">
                <label for="poneys" class="form-label"><i class="fas fa-horse"></i> Assigner des poneys</label>
                <div class="row">
                    @for ($i = 0; $i < 5; $i++) <!-- Limiter à 5 poneys maximum -->
                    <div class="col-md-6">
                        <select name="poneys[]" class="form-control mb-3 @error('poneys.' . $i) is-invalid @enderror" {{ $i === 0 ? 'required' : '' }}>
                            <option value="" disabled selected>Choisissez un poney</option>
                            @foreach ($poneys as $poney)
                                <option value="{{ $poney->id }}" {{ (old('poneys.' . $i) == $poney->id) ? 'selected' : '' }}>{{ $poney->nom }}</option>
                            @endforeach
                        </select>
                        @error('poneys.' . $i)
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
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
