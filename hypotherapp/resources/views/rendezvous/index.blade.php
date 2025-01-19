@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-5">Gestion journalière</h1>

        <div class="row">
            <!-- Section Gestion journalière -->
            <div class="col-md-8">
                <h3 class="mb-4">{{ ucfirst(\Carbon\Carbon::now()->isoFormat('dddd D MMMM YYYY')) }}</h3>

                <!-- Nouveau bouton pour créer un rendez-vous -->
                <button class="btn btn-success mb-4" onclick="window.location='{{ route('rendezvous.create') }}'">
                    <i class="fas fa-plus-circle"></i> Nouveau Rendez-vous
                </button>

                <h4 class="mb-3">Rendez-vous prévus :</h4>

                @forelse ($rendezVous as $rdv)
                    <div class="card mb-3">
                        <div class="card-header d-flex justify-content-between align-items-center"
                             onclick="toggleContent('rdv-{{ $rdv->id }}')"
                             style="cursor: pointer;">
                            <span>
                                <i class="fas fa-user"></i> {{ $rdv->client->nom }} ({{ $rdv->horaire }})
                            </span>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="card-body collapse" id="rdv-{{ $rdv->id }}">
                            <p><strong>Nombre de personnes attendues :</strong> {{ $rdv->nombre_personnes }}</p>
                            <form action="{{ route('rendezvous.assigner', $rdv->id) }}" method="POST">
                                @csrf
                                <div class="row">
                                    @for ($i = 1; $i <= $rdv->nombre_personnes; $i++)
                                        <div class="col-md-6 mb-3">
                                            <label for="poney{{ $i }}">Poney {{ $i }}</label>
                                            <select name="poneys[]" class="form-select" required>
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
                @empty
                    <p class="text-muted">Aucun rendez-vous prévu pour aujourd'hui.</p>
                @endforelse
            </div>

            <!-- Section Enregistrer un nouveau client -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header text-bg-light text-center">
                        <h3 class="mb-0">Enregistrer un nouveau client</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('clients.store') }}" method="POST">
                            @csrf
                            <!-- Champ Nom du Client -->
                            <div class="mb-4">
                                <label for="nom_client" class="form-label">Nom du client</label>
                                <input type="text" class="form-control" id="nom_client" name="nom_client"
                                       placeholder="Ex : Jean Dupont" required>
                            </div>

                            <!-- Champ Nombre de Personnes -->
                            <div class="mb-4">
                                <label for="nombre_personnes" class="form-label">Nombre de personnes</label>
                                <input type="number" class="form-control" id="nombre_personnes" name="nombre_personnes"
                                       min="1" placeholder="Ex : 2" required>
                            </div>

                            <!-- Champ Heures -->
                            <div class="mb-4">
                                <label for="heures" class="form-label">Durée (en heures)</label>
                                <input type="number" class="form-control" id="heures" name="heures"
                                       placeholder="Ex : 3" min="1" max="6" required>
                            </div>

                            <!-- Champ Prix -->
                            <div class="mb-4">
                                <label for="prix" class="form-label">Prix Total (€)</label>
                                <input type="number" class="form-control" id="prix" name="prix" readonly>
                            </div>

                            <!-- Champ Poneys -->
                            <div class="mb-4">
                                <label for="poneys" class="form-label">Assigner des poneys</label>
                                <div class="row">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <div class="col-md-6">
                                            <select name="poneys[]" class="form-select mb-2" required>
                                                <option value="" disabled selected>Poney {{ $i }}</option>
                                                @foreach ($poneys as $poney)
                                                    <option value="{{ $poney->id }}">{{ $poney->nom }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endfor
                                </div>
                            </div>

                            <!-- Bouton Enregistrer -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Enregistrer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Arrière-plan */
        body {
            background-color: #f8f9fa; /* Blanc cassé */
            font-family: 'Poppins', sans-serif;
            color: #2c3e50; /* Gris foncé */
        }

        /* Titres */
        h1, h2, h3, h4 {
            color: #2c3e50; /* Gris foncé */
            font-weight: 600;
        }

        /* Cartes */
        .card {
            border: none;
            border-radius: 10px;
            background: white;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .card-header {
            background-color: #6c5ce7; /* Violet doux */
            color: white;
            font-weight: 500;
        }

        /* Boutons */
        .btn {
            border-radius: 25px;
            font-weight: 500;
            padding: 0.5rem 1.5rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .btn-primary, .btn-success {
            background-color: #6c5ce7; /* Violet doux */
            border-color: #6c5ce7;
            color: white;
        }

        .btn-primary:hover, .btn-success:hover {
            background-color: #5a4acf; /* Violet plus foncé */
            border-color: #5a4acf;
        }

        /* Formulaires */
        .form-control {
            border-radius: 10px;
            border: 1px solid #ddd;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .form-control:focus {
            border-color: #6c5ce7; /* Violet doux */
            box-shadow: 0 0 5px rgba(108, 92, 231, 0.5);
        }

        /* Alignement centré pour l'en-tête du formulaire */
        .card-header {
            text-align: center;
        }
    </style>

    <script>
        // Affichage/dissimulation du contenu d'une carte
        function toggleContent(id) {
            const content = document.getElementById(id);
            const isCollapsed = content.classList.contains('collapse');
            content.classList.toggle('collapse', !isCollapsed);

        }

        // Calcul dynamique du prix
        document.addEventListener('DOMContentLoaded', function () {
            const nombrePersonnesInput = document.getElementById('nombre_personnes');
            const heuresInput = document.getElementById('heures');
            const prixInput = document.getElementById('prix');

            function calculerPrix() {
                const nombrePersonnes = parseInt(nombrePersonnesInput.value) || 0;
                const heures = parseInt(heuresInput.value) || 0;
                const prix = nombrePersonnes * heures * 100; // 100€/heure par personne
                prixInput.value = prix;
            }

            nombrePersonnesInput.addEventListener('input', calculerPrix);
            heuresInput.addEventListener('input', calculerPrix);
        });
    </script>
@endsection
