@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-5">Gestion journalière</h1>

        <div class="row">
            <!-- Section Gestion journalière -->
            <div class="col-md-8">
                <h3 class="mb-4">Mercredi 2 Octobre 2024 :</h3>

                <!-- Nouveau bouton pour créer un rendez-vous -->
                <button class="btn btn-success mb-4" onclick="window.location='{{ route('rendezvous.create') }}'">
                    <i class="fas fa-plus-circle"></i> Nouveau Rendez-vous
                </button>

                <h4 class="mb-3">Rendez-vous prévus :</h4>

                @foreach ($rendezVous as $rdv)
                    <div class="card mb-3 shadow">
                        <div class="card-header d-flex justify-content-between align-items-center" onclick="toggleContent('rdv-{{ $rdv->id }}')" style="cursor: pointer;">
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
            </div>

            <!-- Section Enregistrer un nouveau client -->
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0">Enregistrer un nouveau client</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('clients.store') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="nom_client">Nom du client</label>
                                <input type="text" class="form-control" id="nom_client" name="nom_client" placeholder="Ex : Jean Dupont" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="nombre_personnes">Nombre de personnes</label>
                                <input type="number" class="form-control" id="nombre_personnes" name="nombre_personnes" min="1" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="horaire">Heures</label>
                                <input type="number" class="form-control" id="heures" name="heures" placeholder="Ex : 6" min="1" max ="6" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="prix">Prix</label>
                                <input type="number" class="form-control" id="prix" name="prix" readonly>
                            </div>
                            <div class="form-group mb-3">
                                <label for="poneys">Assigner des poneys</label>
                                <div class="row">
                                    @for ($i = 1; $i <= 5; $i++)
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
                            <button type="submit" class="btn btn-success w-100">Enregistrer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleContent(id) {
            const content = document.getElementById(id);
            const isCollapsed = content.classList.contains('collapse');
            content.classList.toggle('collapse', !isCollapsed);
        }
    </script>
    <!-- Script pour le calcul dynamique -->
    <script>
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
