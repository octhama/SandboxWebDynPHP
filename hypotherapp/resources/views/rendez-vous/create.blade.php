@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-5">Créer un Nouveau Rendez-vous</h1>

        <form action="{{ route('rendez-vous.store') }}" method="POST" class="shadow p-4 rounded bg-light">
            @csrf

            <!-- Sélectionner un client -->
            <div class="form-group mb-4">
                <label for="client_id" class="form-label"><i class="fas fa-user"></i> Sélectionner un client</label>
                <select name="client_id" id="client_id" class="form-select" required>
                    <option value="" disabled selected>Choisissez un client</option>
                    @foreach ($clients as $client)
                        <option value="{{ $client->id }}">{{ $client->nom }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Nombre de personnes -->
            <div class="form-group mb-4">
                <label for="nombre_personnes" class="form-label"><i class="fas fa-users"></i> Nombre de personnes</label>
                <input type="number" class="form-control" id="nombre_personnes" name="nombre_personnes" min="1" max="{{ count($poneys) }}" placeholder="Maximum : {{ count($poneys) }}" required>
            </div>

            <!-- Heure début et fin -->
            <div class="form-group mb-4">
                <label for="horaire" class="form-label"><i class="fas fa-clock"></i> Horaire</label>
                <div class="d-flex align-items-center">
                    <input type="time" class="form-control me-2" id="horaire_debut" name="horaire_debut" required>
                    <span class="mx-2">-</span>
                    <input type="time" class="form-control ms-2" id="horaire_fin" name="horaire_fin" required>
                </div>
            </div>

            <!-- Assigner des poneys -->
            <div class="form-group mb-4">
                <label for="poneys" class="form-label"><i class="fas fa-horse"></i> Assigner des poneys</label>
                <div id="poneys-container" class="row row-cols-2 g-3">
                    @for ($i = 1; $i <= count($poneys); $i++)
                        <div class="col">
                            <label for="poney-select-{{ $i }}" class="form-label">Poney {{ $i }}</label>
                            <select name="poneys[]" id="poney-select-{{ $i }}" class="form-select" {{ $i === 1 ? 'required' : '' }}>
                                <option value="" disabled selected>Choisissez un poney</option>
                                @foreach ($poneys as $poney)
                                    <option value="{{ $poney->id }}"
                                        {{ in_array($poney->id, old('poneys', [])) ? 'disabled' : '' }}>
                                        {{ $poney->nom }}
                                    </option>
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

        /* Style pour aligner les champs heure */
        .form-group .d-flex input[type="time"] {
            flex: 1;
            max-width: 200px; /* Ajustez cette valeur si nécessaire */
        }

        .form-group .d-flex span {
            font-weight: bold;
            font-size: 1.2rem;
        }
    </style>
@endsection
