@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Gestion journalière</h1>

        <div class="row">
            <!-- Section Gestion journalière -->
            <div class="col-md-8">
                <h3>Mercredi 2 Octobre 2024 :</h3>
                <h4>Rendez-vous prévus :</h4>

                @foreach ($rendezVous as $rdv)
                    <div class="card mb-3">
                        <div class="card-header" onclick="toggleContent('rdv-{{ $rdv->id }}')" style="cursor: pointer;">
                            {{ $rdv->client->nom }} ({{ $rdv->horaire }})
                        </div>
                        <div class="card-body" id="rdv-{{ $rdv->id }}" style="display: none;">
                            <p>Nombre de personnes attendues : {{ $rdv->nombre_personnes }}</p>
                            <form action="{{ route('rendezvous.assigner', $rdv->id) }}" method="POST">
                                @csrf
                                <div class="row">
                                    @for ($i = 1; $i <= $rdv->nombre_personnes; $i++)
                                        <div class="col">
                                            <label for="poney{{ $i }}">Poney {{ $i }}</label>
                                            <select name="poneys[]" class="form-control" required>
                                                @foreach ($poneys as $poney)
                                                    <option value="{{ $poney->id }}">{{ $poney->nom }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endfor
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Confirmer</button>
                            </form>
                        </div>
                    </div>
                @endforeach

                <!-- Nouveau bouton pour créer un rendez-vous -->
                <button class="btn btn-success mt-4" onclick="window.location='{{ route('rendezvous.create') }}'">
                    Nouveau Rendez-vous
                </button>
            </div>

            <!-- Section Enregistrer un nouveau client -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3>Enregistrer un nouveau client</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('clients.store') }}" method="POST">
                            @csrf
                            <!-- Nom du client -->
                            <div class="form-group">
                                <label for="nom_client">Nom du client</label>
                                <input type="text" class="form-control" id="nom_client" name="nom_client" required>
                            </div>

                            <!-- Nombre de personnes -->
                            <div class="form-group">
                                <label for="nombre_personnes">Nombre de personnes</label>
                                <input type="number" class="form-control" id="nombre_personnes" name="nombre_personnes" min="1" required>
                            </div>

                            <!-- Heures (simple input limité aux chiffres) -->
                            <div class="form-group">
                                <label for="horaire">Heures</label>
                                <input type="number" class="form-control" id="horaire" name="horaire" min="1" max="6" required placeholder="Maximum 6h">
                            </div>

                            <!-- Prix (calculé automatiquement) -->
                            <div class="form-group">
                                <label for="prix">Prix</label>
                                <input type="number" class="form-control" id="prix" name="prix" min="0" required readonly>
                            </div>

                            <!-- Assigner des poneys -->
                            <div class="form-group">
                                <label for="poneys">Assigner des poneys</label>
                                <div class="row">
                                    @for ($i = 1; $i <= 5; $i++) <!-- Limiter à 5 poneys maximum -->
                                    <div class="col-md-6">
                                        <select name="poneys[]" class="form-control mb-2" required>
                                            @foreach ($poneys as $poney)
                                                <option value="{{ $poney->id }}">{{ $poney->nom }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @endfor
                                </div>
                            </div>

                            <!-- Bouton d'enregistrement -->
                            <button type="submit" class="btn btn-success mt-3">Enregistrer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleContent(id) {
            var content = document.getElementById(id);
            content.style.display = content.style.display === "none" ? "block" : "none";
        }
    </script>
    <!-- Script pour le calcul dynamique -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const nombrePersonnesInput = document.getElementById('nombre_personnes');
            const horaireInput = document.getElementById('horaire');
            const prixInput = document.getElementById('prix');

            function calculerPrix() {
                const nombrePersonnes = parseInt(nombrePersonnesInput.value) || 0;
                const heures = parseInt(horaireInput.value) || 0;
                const prix = nombrePersonnes * heures * 100; // 100€/heure par personne
                prixInput.value = prix;
            }

            nombrePersonnesInput.addEventListener('input', calculerPrix);
            horaireInput.addEventListener('input', calculerPrix);
        });
    </script>
@endsection
