@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Gestion des poneys</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row">
            <div class="col-md-8">
                <h3>Liste des poneys</h3>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Disponible</th>
                        <th>Heures travaillées</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($poneys as $poney)
                        <tr>
                            <td>{{ $poney->nom }}</td>
                            <td>
                                @if ($poney->disponible)
                                    <span class="badge bg-success">Disponible</span>
                                @else
                                    <span class="badge bg-danger">Indisponible</span>
                                @endif
                            </td>
                            <td>{{ $poney->heures_travail_effectuee }} heures</td>
                            <td>
                                <a href="{{ route('poneys.edit', $poney->id) }}" class="btn btn-warning btn-sm">Éditer</a>
                                <form action="{{ route('poneys.destroy', $poney->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ce poney ?')">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="col-md-4">
                <h3>Ajouter un nouveau poney</h3>
                <form action="{{ route('poneys.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nom">Nom du poney</label>
                        <input type="text" class="form-control" name="nom" required>
                    </div>
                    <div class="form-group">
                        <label for="heures_travail_max">Heures de travail max</label>
                        <input type="number" class="form-control" name="heures_travail_max" required>
                    </div>
                    <button type="submit" class="btn btn-success">Ajouter</button>
                </form>
            </div>
        </div>
    </div>
@endsection
