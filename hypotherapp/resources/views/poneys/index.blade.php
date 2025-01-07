@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h1 class="mb-4 text-center">Gestion des Poneys</h1>

        <!-- Alertes de succès -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            <!-- Section Liste des Poneys -->
            <div class="col-md-8">
                <table class="table table-striped table-bordered align-middle">
                    <thead class="table-dark">
                    <tr>
                        <th>Nom</th>
                        <th>Heures actuelles / Max</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($poneys as $poney)
                        <tr>
                            <td>{{ $poney->nom }}</td>
                            <td>{{ $poney->current_hours }}h à {{ $poney->max_work_hours }}h</td>
                            <td>
                                @if($poney->id)
                                    <a href="{{ route('poneys.edit', $poney->id) }}" class="btn btn-warning btn-sm me-1">Modifier</a>
                                    <form action="{{ route('poneys.destroy', $poney->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                                    </form>
                                @else
                                    <span class="text-danger">Action impossible</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Section Ajouter un nouveau Poney -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Ajouter un nouveau Poney</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('poneys.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="nom" class="form-label">Nom du Poney</label>
                                <input type="text" id="nom" name="nom" class="form-control" placeholder="Entrez un nom" required>
                            </div>
                            <div class="mb-3">
                                <label for="max_work_hours" class="form-label">Heures de travail max</label>
                                <input type="number" id="max_work_hours" name="max_work_hours" class="form-control" placeholder="Ex : 5" required>
                            </div>
                            <button type="submit" class="btn btn-success w-100">Ajouter</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
