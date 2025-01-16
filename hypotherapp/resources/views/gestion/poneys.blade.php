@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-4">Gestion des poneys</h1>

        <!-- Formulaire pour ajouter un poney -->
        <div class="card mb-4">
            <div class="card-header">
                <h3>Ajouter un nouveau poney</h3>
            </div>
            <div class="card-body">
                <form action="/ajouter-poney" method="POST" class="row g-3">
                    @csrf
                    <div class="col-md-6">
                        <label for="nom" class="form-label">Nom du poney</label>
                        <input type="text" name="nom" id="nom" class="form-control" placeholder="Nom du poney" required>
                    </div>
                    <div class="col-md-6">
                        <label for="heures_max" class="form-label">Heures maximales</label>
                        <input type="number" name="heures_max" id="heures_max" class="form-control" placeholder="Heures max" required>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Liste des poneys -->
        <div class="card">
            <div class="card-header">
                <h3>Liste des poneys</h3>
            </div>
            <div class="card-body">
                @if ($poneys->isEmpty())
                    <p class="text-center">Aucun poney n'a été ajouté pour le moment.</p>
                @else
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Heures de travail</th>
                            <th>Heures maximales</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($poneys as $poney)
                            <tr>
                                <td>{{ $poney->nom }}</td>
                                <td>{{ $poney->heures_travail }}</td>
                                <td>{{ $poney->heures_max }}</td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <form action="/modifier-poney/{{ $poney->id }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-warning btn-sm">Modifier</button>
                                        </form>
                                        <form action="/supprimer-poney/{{ $poney->id }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection
