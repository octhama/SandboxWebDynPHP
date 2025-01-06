@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h1 class="mb-4">Modifier le Poney : {{ $poney->nom }}</h1>

        <form action="{{ route('poneys.update', $poney->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" name="nom" class="form-control" value="{{ $poney->nom }}" required>
            </div>
            <div class="mb-3">
                <label for="max_work_hours" class="form-label">Heures de travail max</label>
                <input type="number" name="max_work_hours" class="form-control" value="{{ $poney->max_work_hours }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Sauvegarder</button>
            <a href="{{ route('poneys.index') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
@endsection
