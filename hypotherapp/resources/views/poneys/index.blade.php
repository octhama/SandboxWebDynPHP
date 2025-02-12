@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-5">Gestion des Poneys</h1>
        <div class="row">
            <!-- Liste des poneys -->
            <div class="col-md-8">
                <table class="table table-hover table-bordered">
                    <thead class="table-dark">
                    <tr>
                        <th>Nom</th>
                        <th>Disponible</th>
                        <th>Heures travaillées</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($poneys as $poney)
                        <tr class="{{ $poney->disponible ? 'table-success' : 'table-danger' }}">
                            <td>{{ $poney->nom }}</td>
                            <td>
                                    <span class="badge {{ $poney->disponible ? 'bg-success' : 'bg-danger' }}">
                                        <i class="fas {{ $poney->disponible ? 'fa-check-circle' : 'fa-times-circle' }}"></i>
                                        {{ $poney->disponible ? 'Disponible' : 'Indisponible' }}
                                    </span>
                            </td>
                            <td> {{ $poney->heures_travail_validee }} / 8 heures</td>
                            <td>
                                <a href="{{ route('poneys.edit', $poney->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Modifier
                                </a>
                                <form action="{{ route('poneys.destroy', $poney->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ce poney ?')">
                                        <i class="fas fa-trash-alt"></i> Supprimer
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">Aucun poney enregistré.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Ajouter un nouveau poney -->
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-header text-bg-light">
                        <h4><i class="fas fa-plus"></i> Ajouter un nouveau poney</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('poneys.store') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="nom"><i class="fas fa-horse"></i> Nom du poney</label>
                                <input type="text" class="form-control" name="nom" placeholder="Ex : Spirit" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="heures_travail_validee"><i class="fas fa-clock"></i> Heures travaillées</label>
                                <input type="number" class="form-control" name="heures_travail_validee" placeholder="Ex : 6" min="1" max="24" required>
                            </div>
                            <button type="submit" class="btn btn-success w-100">
                                <i class="fas fa-save"></i> Ajouter
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Styles supplémentaires -->
    <style>
        /* Arrière-plan */
        body {
            background-color: #f8f9fa; /* Blanc cassé */
            font-family: 'Poppins', sans-serif;
            color: #2c3e50; /* Gris foncé */
        }

        .table-hover tbody tr:hover {
            background-color: rgba(0, 123, 255, 0.1);
        }
        .btn-success, .btn-warning, .btn-danger {
            transition: all 0.3s ease;
        }
        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }
        .btn-warning:hover {
            background-color: #e0a800;
            border-color: #d39e00;
        }
        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }
    </style>
@endsection
