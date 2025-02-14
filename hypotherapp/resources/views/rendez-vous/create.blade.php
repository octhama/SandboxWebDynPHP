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
                <input type="number" class="form-control" id="nombre_personnes" name="nombre_personnes"
                       min="1" max="{{ count($poneys) }}" placeholder="Maximum : {{ count($poneys) }}"
                       required value="{{ old('nombre_personnes') }}">
            </div>

            <!-- Plages horaires disponibles -->
            <div class="form-group mb-4">
                <label for="creneaux" class="form-label"><i class="fas fa-clock"></i> Choisissez une plage horaire</label>
                <select name="creneaux" id="creneaux" class="form-select" required>
                    <option value="" disabled selected>Choisissez une plage horaire</option>
                    @php
                        $reservations = $reservations ?? collect(); // Définit une collection vide si $reservations n'existe pas
                    @endphp

                    @foreach ($disponibilites as $interval)
                        @php
                            $creneau = $interval->start->format('H:i') . '-' . $interval->end->format('H:i');
                            $estReserve = $reservations->contains(fn($rdv) =>
                                optional($rdv->horaire_debut)->format('H:i') === $interval->start->format('H:i') &&
                                optional($rdv->horaire_fin)->format('H:i') === $interval->end->format('H:i')
                            );
                        @endphp

                        <option value="{{ $creneau }}" {{ $estReserve ? 'disabled' : '' }}>
                            {{ $interval->start->format('H:i') }} - {{ $interval->end->format('H:i') }}
                            @if ($estReserve) (Réservé) @endif
                        </option>
                    @endforeach

                </select>
            </div>

            <!-- Assigner des poneys -->
            <div class="form-group mb-4">
                <label for="poneys" class="form-label"><i class="fas fa-horse"></i> Assigner des poneys</label>
                <div id="poneys-container" class="row row-cols-2 g-3">
                    @php
                        $selectedPoneys = old('poneys', []);
                        $poneysRestants = $poneys->pluck('id')->diff($selectedPoneys);
                    @endphp
                    @foreach (range(1, count($poneys)) as $i)
                        <div class="col">
                            <label for="poney-select-{{ $i }}" class="form-label">Poney {{ $i }}</label>
                            <select name="poneys[]" id="poney-select-{{ $i }}" class="form-select">
                                <option value="" disabled selected>Choisissez un poney</option>
                                @foreach ($poneys as $poney)
                                    <option value="{{ $poney->id }}"
                                        {{ in_array($poney->id, $selectedPoneys) ? 'disabled' : '' }}
                                        {{ isset($selectedPoneys[$i - 1]) && $selectedPoneys[$i - 1] == $poney->id ? 'selected' : '' }}>
                                        {{ $poney->nom }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @endforeach
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

    <!-- Script pour désactiver les poneys déjà assignés -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            function updatePoneyOptions() {
                let selectedPoneys = new Set();
                let selects = document.querySelectorAll('select[name="poneys[]"]');

                // Collecter les poneys sélectionnés
                selects.forEach(select => {
                    if (select.value) {
                        selectedPoneys.add(select.value);
                    }
                });

                // Désactiver les poneys déjà sélectionnés dans les autres listes
                selects.forEach(select => {
                    let options = select.querySelectorAll('option');

                    options.forEach(option => {
                        if (option.value) {
                            if (selectedPoneys.has(option.value) && option.value !== select.value) {
                                option.disabled = true;
                                option.textContent = option.textContent.replace(' (Pris)', '') + ' (Pris)';
                            } else {
                                option.disabled = false;
                                option.textContent = option.textContent.replace(' (Pris)', '');
                            }
                        }
                    });
                });
            }

            // Ajouter un événement sur chaque select pour mettre à jour dynamiquement
            document.querySelectorAll('select[name="poneys[]"]').forEach(select => {
                select.addEventListener('change', updatePoneyOptions);
            });

            // Appliquer la mise à jour au chargement de la page
            updatePoneyOptions();
        });
    </script>

    <!-- Script pour remplir le nombre de personnes automatiquement -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const clientSelect = document.getElementById('client_id');
            const nombrePersonnesInput = document.getElementById('nombre_personnes');
            const clientsData = @json($clients->pluck('nombre_personnes', 'id'));

            clientSelect.addEventListener('change', function () {
                let clientId = this.value;
                if (clientId && clientsData[clientId]) {
                    nombrePersonnesInput.value = clientsData[clientId];
                    nombrePersonnesInput.setAttribute('readonly', true); // Empêcher la modification
                } else {
                    nombrePersonnesInput.value = "";
                    nombrePersonnesInput.removeAttribute('readonly');
                }
            });
        });
    </script>


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
        .text-danger {
            font-weight: bold;
            font-size: 1rem;
        }
    </style>
@endsection
