@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-5">Gestion des Poneys</h1>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            <!-- Liste des poneys -->
            <div class="col-md-8 mb-4">
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
                    @foreach ($poneys as $poney)
                        <tr class="{{ $poney->disponible ? 'table-success' : 'table-danger' }}">
                            <td>{{ $poney->nom }}</td>
                            <td>
                                @if ($poney->disponible)
                                    <span class="badge bg-success"><i class="fas fa-check-circle"></i> Disponible</span>
                                @else
                                    <span class="badge bg-danger"><i class="fas fa-times-circle"></i> Indisponible</span>
                                @endif
                            </td>
                            <td>{{ $poney->heures_travail_effectuee }} heures</td>
                            <td>
                                <a href="{{ route('poneys.edit', $poney->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Éditer
                                </a>
                                <form action="{{ route('poneys.destroy', $poney->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ce poney ?')">
                                        <i class="fas fa-trash-alt"></i> Supprimer
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
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
                            <!-- Nom du poney -->
                            <div class="form-group mb-3">
                                <label for="nom"><i class="fas fa-horse"></i> Nom du poney</label>
                                <input type="text" class="form-control" name="nom" placeholder="Ex : Spirit" required>
                            </div>
                            <!-- Heures de travail max -->
                            <div class="form-group mb-3">
                                <label for="heures_travail_max"><i class="fas fa-clock"></i> Heures de travail max</label>
                                <input type="number" class="form-control" name="heures_travail_max" placeholder="Ex : 6" min="1" max="6" required>
                            </div>
                            <!-- Bouton d'ajout -->
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save"></i> Ajouter
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Styles supplémentaires -->
    <style>
        /* Titres */
        h1, h2, h3, h4 {
            color: #2c3e50; /* Gris foncé */
            font-weight: 600;
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
