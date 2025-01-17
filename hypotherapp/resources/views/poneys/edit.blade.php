@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-5">Modifier le Poney : <strong>{{ $poney->nom }}</strong></h1>

        <!-- Afficher les erreurs -->
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><i class="fas fa-exclamation-circle"></i> Erreurs détectées :</strong>
                <ul class="mt-2 mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Formulaire de modification -->
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0"><i class="fas fa-pencil-alt"></i> Modifier les informations</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('poneys.update', $poney->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Nom du poney -->
                    <div class="form-group mb-3">
                        <label for="nom" class="form-label"><i class="fas fa-horse"></i> Nom du poney</label>
                        <input type="text" class="form-control" id="nom" name="nom" value="{{ $poney->nom }}" required>
                    </div>

                    <!-- Heures de travail effectuées -->
                    <div class="form-group mb-3">
                        <label for="heures_travail_effectuee" class="form-label"><i class="fas fa-clock"></i> Heures de travail effectuées</label>
                        <input type="number" class="form-control" id="heures_travail_effectuee" name="heures_travail_effectuee"
                               value="{{ $poney->heures_travail_effectuee }}" required>
                    </div>

                    <!-- Disponibilité -->
                    <div class="form-check form-switch mb-4">
                        <input class="form-check-input" type="checkbox" id="disponible" name="disponible" value="1" {{ $poney->disponible ? 'checked' : '' }}>
                        <label class="form-check-label" for="disponible"><i class="fas fa-check-circle"></i> Disponible</label>
                    </div>

                    <!-- Boutons d'action -->
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Mettre à jour</button>
                        <a href="{{ route('poneys.index') }}" class="btn btn-secondary"><i class="fas fa-undo"></i> Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Styles supplémentaires -->
    <style>
        .btn-success, .btn-secondary {
            transition: all 0.3s ease;
        }
        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }
        .btn-secondary:hover {
            background-color: #6c757d;
            border-color: #5a6268;
        }
    </style>
@endsection
