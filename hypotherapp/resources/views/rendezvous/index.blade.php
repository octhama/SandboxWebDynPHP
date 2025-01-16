@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-4">Liste des Rendez-vous</h1>

        <!-- Message de succès -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Liste des rendez-vous -->
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

        <!-- Bouton pour créer un nouveau rendez-vous -->
        <div class="text-center mt-4">
            <a href="{{ route('rendezvous.create') }}" class="btn btn-primary">Créer un nouveau rendez-vous</a>
        </div>
    </div>
@endsection
