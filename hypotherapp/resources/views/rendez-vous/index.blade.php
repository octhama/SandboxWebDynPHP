@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-5 fw-bold">Gestion journalière</h1>

        <div class="row">
            <!-- Section Rendez-vous -->
            <div class="col-md-7">
                <h3 class="mb-4">{{ ucfirst(\Carbon\Carbon::now()->isoFormat('dddd D MMMM YYYY')) }}</h3>

                <a href="{{ route('rendez-vous.create') }}" class="btn btn-success mb-4 shadow">
                    <i class="fas fa-plus-circle"></i> Nouveau Rendez-vous
                </a>

                <h4 class="mb-3">📌 Rendez-vous prévus</h4>

                <div class="list-group">
                    @forelse ($rendezVous as $rdv)
                        <div class="list-group-item list-group-item-action">
                            <div class="d-flex justify-content-between align-items-center"
                                 data-bs-toggle="collapse"
                                 data-bs-target="#rdv-{{ $rdv->id }}"
                                 style="cursor: pointer;">
                                <span>
                                    <i class="fas fa-user"></i> {{ $rdv->client->nom }}
                                    (🕒 {{ $rdv->horaire_debut->format('H:i') }} - {{ $rdv->horaire_fin->format('H:i') }})
                                </span>
                                <i class="fas fa-chevron-down transition-icon"></i>
                            </div>

                            <div id="rdv-{{ $rdv->id }}" class="collapse mt-2">
                                <p><strong>👥 Nombre de personnes :</strong> {{ $rdv->nombre_personnes }}</p>
                                <p><strong>🐴 Poneys assignés :</strong>
                                    @foreach ($rdv->poneys as $poney)
                                        <span class="badge bg-primary">{{ $poney->nom }}</span>
                                    @endforeach
                                </p>

                                <div class="d-flex">
                                    <form action="{{ route('rendez-vous.confirm', $rdv->id) }}" method="POST" class="me-2">
                                        @csrf
                                        <button type="submit" class="btn btn-light border shadow-sm">
                                            ✅
                                        </button>
                                    </form>

                                    <form action="{{ route('rendez-vous.reset', $rdv->id) }}" method="POST" class="me-2">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-light border shadow-sm">
                                            🔄
                                        </button>
                                    </form>

                                    <form action="{{ route('rendez-vous.destroy', $rdv->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-light border shadow-sm"
                                                onclick="return confirm('❌ Êtes-vous sûr de vouloir supprimer ce rendez-vous ?')">
                                            🗑️
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted">Aucun rendez-vous prévu pour aujourd'hui.</p>
                    @endforelse
                </div>
            </div>

            <!-- Section Nouveau client -->
            <div class="col-md-5">
                <div class="card shadow">
                    <div class="card-header text-bg-light text-center">
                        <h3 class="mb-0">Enregistrer un nouveau client</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('clients.store') }}" method="POST" id="clientForm">
                            @csrf
                            <div class="mb-4">
                                <label for="nom_client" class="form-label">👤 Nom du client</label>
                                <input type="text" class="form-control" id="nom_client" name="nom" value="{{ old('nom') }}" required>
                            </div>
                            <div class="mb-4">
                                <label for="nombre_personnes" class="form-label">👥 Nombre de personnes</label>
                                <input type="number" class="form-control" id="nombre_personnes" name="nombre_personnes"
                                       min="1" max="{{ count($poneys) }}" placeholder="Max : {{ count($poneys) }}" required
                                       value="{{ old('nombre_personnes') }}">
                            </div>
                            <div class="mb-4">
                                <label for="heures" class="form-label">🕒 Nombre d'heures</label>
                                <input type="number" class="form-control" id="heures" name="heures" value="{{ old('heures', 1) }}" min="1" max="8" required>
                            </div>
                            <div class="mb-4">
                                <label for="prix_total" class="form-label">💰 Prix total</label>
                                <input type="text" class="form-control" id="prix_total" name="prix_total" value="{{ old('prix_total', session('prixTotal') ?? '') }}" readonly>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">✔️ Enregistrer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<style>
    body {
        background-color: #f8f9fa;
        font-family: 'Poppins', sans-serif;
        color: #2c3e50;
    }

    h1, h2, h3, h4 {
        color: #2c3e50;
        font-weight: 600;
    }

    .list-group-item {
        border: none;
        border-radius: 10px;
        background: white;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        margin-bottom: 10px;
    }

    .list-group-item:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
    }

    /* Animation des icônes */
    .transition-icon {
        transition: transform 0.3s ease-in-out;
    }

    .collapsed .transition-icon {
        transform: rotate(0deg);
    }

    .show .transition-icon {
        transform: rotate(180deg);
    }

    /* Animation des boutons */
    .btn-light {
        transition: all 0.2s ease-in-out;
    }

    .btn-light:hover {
        transform: scale(1.1);
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
    }

    .form-control {
        border-radius: 10px;
        border: 1px solid #ddd;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .form-control:focus {
        border-color: #6c5ce7;
        box-shadow: 0 0 5px rgba(108, 92, 231, 0.5);
    }

    .card {
        border-radius: 15px;
        overflow: hidden;
    }

    .card-header {
        background: #6c5ce7;
        color: white;
        text-align: center;
        font-weight: bold;
    }
</style>
