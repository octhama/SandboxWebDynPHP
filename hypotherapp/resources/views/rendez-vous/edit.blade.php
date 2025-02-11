@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-5">Modifier le Rendez-vous</h1>

        <form action="{{ route('rendez-vous.update', $rendezVous->id) }}" method="POST" class="shadow p-4 rounded bg-light">
            @csrf
            @method('PUT')

            <!-- Sélectionner un client -->
            <div class="form-group mb-4">
                <label for="client_id" class="form-label"><i class="fas fa-user"></i> Sélectionner un client</label>
                <select name="client_id" id="client_id" class="form-select" required>
                    <option value="" disabled>Choisissez un client</option>
                    @foreach ($clients as $client)
                        <option value="{{ $client->id }}" {{ $client->id === $rendezVous->client_id ? 'selected' : '' }}>
                            {{ $client->nom }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Nombre de personnes -->
            <div class="form-group mb-4">
                <label for="nombre_personnes" class="form-label"><i class="fas fa-users"></i> Nombre de personnes</label>
                <input type="number" class="form-control" id="nombre_personnes" name="nombre_personnes"
                       min="1" max="{{ count($poneys) }}" placeholder="Maximum : {{ count($poneys) }}"
                       required value="{{ $rendezVous->nombre_personnes }}">
            </div>

            <!-- Plages horaires disponibles -->
            <div class="form-group mb-4">
                <label for="creneaux" class="form-label"><i class="fas fa-clock"></i> Plages horaires disponibles</label>
                <select name="creneaux" id="creneaux" class="form-select" required>
                    <option value="" disabled>Choisissez une plage horaire</option>
                    @foreach ($disponibilites as $interval)
                        @php
                            if ($interval->start && $interval->end) {
                                $creneau = \Carbon\Carbon::parse($interval->start)->format('H:i') . '-' . \Carbon\Carbon::parse($interval->end)->format('H:i');
                            } else {
                                continue; // Ignore les créneaux non valides
                            }

                            $estReserve = collect($reservations)->contains(fn($rdv) =>
                                $rdv->start && $rdv->end &&
                                \Carbon\Carbon::parse($rdv->start)->format('H:i') === \Carbon\Carbon::parse($interval->start)->format('H:i') &&
                                \Carbon\Carbon::parse($rdv->end)->format('H:i') === \Carbon\Carbon::parse($interval->end)->format('H:i')
                            );

                            $horaireDebut = $rendezVous->horaire_debut ? \Carbon\Carbon::parse($rendezVous->horaire_debut)->format('H:i') : null;
                            $horaireFin = $rendezVous->horaire_fin ? \Carbon\Carbon::parse($rendezVous->horaire_fin)->format('H:i') : null;
                        @endphp

                        <option value="{{ $creneau }}"
                            {{ ($horaireDebut && $horaireFin &&
                                ($horaireDebut . '-' . $horaireFin) == $creneau) ? 'selected' : '' }}
                            {{ $estReserve ? 'disabled' : '' }}>
                            {{ $creneau }} @if ($estReserve) (Réservé) @endif
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary rounded-pill shadow px-5 py-2">
                    <i class="fas fa-save"></i> Enregistrer
                </button>
            </div>
        </form>
    </div>
@endsection
