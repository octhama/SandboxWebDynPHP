@php use Carbon\Carbon; @endphp
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-5">Modifier le Rendez-vous</h1>

        <form action="{{ route('rendez-vous.update', $rendezVous->id) }}" method="POST"
              class="shadow p-4 rounded bg-light">
            @csrf
            @method('PUT')

            <!-- Nom du client (non modifiable) -->
            <div class="form-group mb-4">
                <label class="form-label"><i class="fas fa-user"></i> Client</label>
                <input type="text" class="form-control" value="{{ $rendezVous->client->nom }}" disabled>
            </div>

            <!-- Nombre de personnes (non modifiable) -->
            <div class="form-group mb-4">
                <label class="form-label"><i class="fas fa-users"></i> Nombre de personnes</label>
                <input type="text" class="form-control" value="{{ $rendezVous->nombre_personnes }}" disabled>
            </div>

            <!-- Plages horaires disponibles -->
            <div class="form-group mb-4">
                <label for="creneaux" class="form-label"><i class="fas fa-clock"></i> Plages horaires
                    disponibles</label>
                <select name="creneaux" id="creneaux" class="form-select" required>
                    <option value="" disabled>Choisissez une plage horaire</option>
                    @foreach ($disponibilites as $interval)
                        @php
                            if ($interval->start && $interval->end) {
                                $creneau = Carbon::parse($interval->start)->format('H:i') . '-' . Carbon::parse($interval->end)->format('H:i');
                            } else {
                                continue; // Ignore les créneaux non valides
                            }

                            $reservations = $rendezVous->client->rendezVous->where('date', $rendezVous->date);
                            $estReserve = collect($reservations)->contains(fn($rdv) =>
                                $rdv->start && $rdv->end &&
                                Carbon::parse($rdv->start)->format('H:i') === Carbon::parse($interval->start)->format('H:i') &&
                                Carbon::parse($rdv->end)->format('H:i') === Carbon::parse($interval->end)->format('H:i')
                            );

                            $horaireDebut = $rendezVous->horaire_debut ? Carbon::parse($rendezVous->horaire_debut)->format('H:i') : null;
                            $horaireFin = $rendezVous->horaire_fin ? Carbon::parse($rendezVous->horaire_fin)->format('H:i') : null;
                        @endphp

                        <option value="{{ $creneau }}"
                            {{ ($horaireDebut && $horaireFin &&
                                ($horaireDebut . '-' . $horaireFin) == $creneau) ? 'selected' : '' }}
                            {{ $estReserve ? 'disabled' : '' }}>
                            {{ $creneau }} @if ($estReserve)
                                (Réservé)
                            @endif
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
