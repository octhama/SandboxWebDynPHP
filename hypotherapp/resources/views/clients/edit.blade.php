@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Modifier le client : <strong>{{ $client->nom }}</strong></h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li><i class="fas fa-exclamation-circle"></i> {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('clients.update', $client->id) }}" method="POST" class="p-4 shadow-sm bg-light rounded">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label for="nom" class="form-label">Nom du client</label>
                <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom', $client->nom) }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="nombre_personnes" class="form-label">Nombre de personnes</label>
                <input type="number" class="form-control" id="nombre_personnes" name="nombre_personnes"
                       value="{{ old('nombre_personnes', $client->nombre_personnes) }}" min="1" required>
            </div>

            <div class="form-group mb-3">
                <label for="minutes" class="form-label">Durée (minutes)</label>
                <input type="number" class="form-control" id="minutes" name="minutes"
                       value="{{ old('minutes', $client->minutes) }}" min="10" max="120" required>
                <small class="text-danger d-none" id="alert-duree"><i class="fas fa-exclamation-triangle"></i> Minimum 10 minutes.</small>
            </div>

            <div class="form-group mb-4">
                <label for="prix_total" class="form-label">Prix total (€)</label>
                <input type="number" class="form-control" id="prix_total" name="prix_total"
                       value="{{ old('prix_total', $client->prix_total) }}" min="0" step="0.01" readonly>
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Mettre à jour</button>
                <a href="{{ route('clients.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Annuler</a>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const tarifParMinute = 185 / 20;
            const nombrePersonnesInput = document.getElementById('nombre_personnes');
            const minutesInput = document.getElementById('minutes');
            const prixTotalInput = document.getElementById('prix_total');
            const alertDuree = document.getElementById('alert-duree');

            function recalculerPrix() {
                let nombrePersonnes = parseInt(nombrePersonnesInput.value) || 1;
                let minutes = parseInt(minutesInput.value) || 0;

                if (minutes < 10) {
                    alertDuree.classList.remove('d-none');
                } else {
                    alertDuree.classList.add('d-none');
                }

                let prixTotal = nombrePersonnes * minutes * tarifParMinute;
                prixTotalInput.value = prixTotal.toFixed(2);
            }

            nombrePersonnesInput.addEventListener('input', recalculerPrix);
            minutesInput.addEventListener('input', recalculerPrix);
            recalculerPrix();
        });
    </script>
@endsection
