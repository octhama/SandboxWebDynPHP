@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-5">Gestion journalière</h1>

        <div class="row">
            <!-- Section Gestion journalière -->
            <div class="col-md-7">
                <h3 class="mb-4">{{ ucfirst(\Carbon\Carbon::now()->isoFormat('dddd D MMMM YYYY')) }}</h3>

                <!-- Bouton pour créer un rendez-vous -->
                <a href="{{ route('rendez-vous.create') }}" class="btn btn-success mb-4">
                    <i class="fas fa-plus-circle"></i> Nouveau Rendez-vous
                </a>

                <h4 class="mb-3">Rendez-vous prévus</h4>

                @forelse ($rendezVous as $rdv)
                    <div class="card mb-3">
                        <div class="card-header d-flex justify-content-between align-items-center"
                             data-bs-toggle="collapse" data-bs-target="#rdv-{{ $rdv->id }}" style="cursor: pointer;">
                            <span>
                                <i class="fas fa-user"></i> {{ $rdv->client->nom }}
                                ({{ $rdv->horaire_debut->format('H:i') }} - {{ $rdv->horaire_fin->format('H:i') }})
                            </span>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div id="rdv-{{ $rdv->id }}" class="collapse">
                            <div class="card-body">
                                <p><strong>Nombre de personnes :</strong> {{ $rdv->nombre_personnes }}</p>
                                <p><strong>Poneys assignés :</strong>
                                    @foreach ($rdv->poneys as $poney)
                                        <span class="badge bg-primary">{{ $poney->nom }}</span>
                                    @endforeach
                                </p>

                                <!-- Boutons d'actions -->
                                <div class="d-flex justify-content-start">
                                    <!-- Bouton Confirmer -->
                                    <form action="{{ route('rendez-vous.confirm', $rdv->id) }}" method="POST" class="me-2">
                                        @csrf
                                        <button type="submit" class="btn btn-light border shadow-sm">
                                            <i class="fas fa-check text-success"></i>
                                        </button>
                                    </form>

                                    <!-- Bouton Réinitialiser -->
                                    <form action="{{ route('rendez-vous.reset', $rdv->id) }}" method="POST" class="me-2">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-light border shadow-sm">
                                            <i class="fas fa-undo text-warning"></i>
                                        </button>
                                    </form>

                                    <!-- Bouton Supprimer -->
                                    <form action="{{ route('rendez-vous.destroy', $rdv->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-light border shadow-sm"
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce rendez-vous ?')">
                                            <i class="fas fa-trash text-danger"></i>
                                        </button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-muted">Aucun rendez-vous prévu pour aujourd'hui.</p>
                @endforelse
            </div>
            <!-- Section Enregistrer un nouveau client -->
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header text-bg-light text-center">
                        <h3 class="mb-0">Enregistrer un nouveau client</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('clients.store') }}" method="POST" id="clientForm">
                            @csrf
                            <div class="mb-4">
                                <label for="nom_client" class="form-label"><i class="fas fa-user"></i> Nom du client</label>
                                <input type="text" class="form-control" id="nom_client" name="nom" value="{{ old('nom') }}" required>
                            </div>
                            <div class="mb-4">
                                <label for="nombre_personnes" class="form-label"><i class="fas fa-users"></i> Nombre de personnes</label>
                                <input type="number" class="form-control" id="nombre_personnes" name="nombre_personnes"
                                       min="1" max="{{ count($poneys) }}" placeholder="Maximum : {{ count($poneys) }}" required
                                       value="{{ old('nombre_personnes') }}">
                            </div>
                            <div class="mb-4">
                                <label for="heures" class="form-label"><i class="fas fa-clock"></i> Nombre d'heures</label>
                                <input type="number" class="form-control" id="heures" name="heures" value="{{ old('heures', 1) }}" min="1" max="8" required>
                            </div>
                            <div class="mb-4">
                                <label for="prix_total" class="form-label"><i class="fas fa-euro-sign"></i> Prix total</label>
                                <input type="text" class="form-control" id="prix_total" name="prix_total" value="{{ old('prix_total', session('prixTotal') ?? '') }}" readonly>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Enregistrer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <script>
                // Fonction pour recalculer le prix total
                function recalculerPrix() {
                    var nombrePersonnes = document.getElementById('nombre_personnes').value;
                    var heures = document.getElementById('heures').value;

                    // Exemple de tarification
                    var tarifParPersonne = 50;  // Tarif par personne en €
                    var tarifParHeure = 50;     // Tarif par heure en €

                    // Calcul du prix total
                    var prixTotal = (nombrePersonnes * tarifParPersonne) + (heures * tarifParHeure);

                    // Affichage du prix total dans le champ
                    document.getElementById('prix_total').value = prixTotal.toFixed(2);
                }

                // Événements pour recalculer le prix à chaque modification
                document.getElementById('nombre_personnes').addEventListener('input', recalculerPrix);
                document.getElementById('heures').addEventListener('input', recalculerPrix);

                // Initialiser le prix au chargement de la page
                recalculerPrix();
            </script>
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
            background-color: #6c5ce7; /* Blanc doux */
            color: white;
            font-weight: 500;
        }

        /* Boutons */
        .btn-light {
            padding: 0.5rem 0.75rem;
            transition: all 0.2s ease-in-out;
        }

        .btn-light:hover {
            transform: scale(1.1);
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
        }

        .fas {
            font-size: 1.2rem;
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
@endsection
