@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h1 class="mb-4">Ajouter un Nouveau Poney</h1>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('poneys.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" name="nom" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="max_work_hours" class="form-label">Heures de travail max</label>
                <input type="number" name="max_work_hours" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Ajouter</button>
            <a href="{{ route('poneys.index') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
@endsection
