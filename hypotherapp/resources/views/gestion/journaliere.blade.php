@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-4">Gestion Journalière</h1>

        <div class="mb-4">
            <p><strong>Date :</strong> {{ $date }}</p>
            <p><strong>Poneys disponibles :</strong> {{ $poneysDisponibles }}</p>
        </div>

        <div class="row">
            <!-- Section : Liste des rendez-vous -->
            <div class="col-md-6">
                <h2>Rendez-vous du jour</h2>
                @if($rendezvous->isEmpty())
                    <p class="text-center">Aucun rendez-vous n'a été enregistré pour le moment.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Client</th>
                                <th>Horaire Début</th>
                                <th>Horaire Fin</th>
                                <th>Poneys</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($rendezvous as $index => $rdv)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $rdv->client->nom }}</td>
                                    <td>{{ $rdv->horaire_debut }}</td>
                                    <td>{{ $rdv->horaire_fin }}</td>
                                    <td>
                                        @foreach($rdv->poneys as $poney)
                                            <span class="badge bg-primary">{{ $poney->nom }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="{{ route('rendezvous.edit', $rdv->id) }}" class="btn btn-sm btn-warning">Modifier</a>
                                        <form action="{{ route('rendezvous.destroy', $rdv->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce rendez-vous ?')">Supprimer</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            <!-- Section : Formulaire de création de rendez-vous -->
            <div class="col-md-6">
                <h2>Créer un rendez-vous</h2>
                <form method="POST" action="{{ route('rendezvous.store') }}" class="card p-3">
                    @csrf
                    <div class="mb-3">
                        <label for="client_id" class="form-label">Client :</label>
                        <select name="client_id" class="form-select" required>
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}">{{ $client->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="horaire_debut" class="form-label">Début :</label>
                        <input type="datetime-local" name="horaire_debut" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="horaire_fin" class="form-label">Fin :</label>
                        <input type="datetime-local" name="horaire_fin" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <h3>Poneys disponibles</h3>
                        @foreach($poneys as $poney)
                            @if($poney->disponible)
                                <div class="form-check">
                                    <input type="checkbox" name="poneys[]" value="{{ $poney->id }}" class="form-check-input">
                                    <label class="form-check-label">{{ $poney->nom }}</label>
                                </div>
                            @endif
                        @endforeach
                        <small class="text-muted">Vous pouvez assigner jusqu'à {{ $poneysDisponibles }} poneys.</small>
                    </div>
                    <button type="submit" class="btn btn-primary">Confirmer</button>
                </form>
            </div>
        </div>

        <hr class="my-4">

        <div class="row">
            <!-- Section : Formulaire d'ajout de clients -->
            <div class="col-md-6">
                <h2>Ajouter un client</h2>
                <form method="POST" action="{{ route('clients.store') }}" class="card p-3">
                    @csrf
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom du groupe :</label>
                        <input type="text" name="nom" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="nb_personnes" class="form-label">Nombre de personnes :</label>
                        <input type="number" name="nb_personnes" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-success">Ajouter</button>
                </form>
            </div>
        </div>
    </div>
@endsection
