@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Modifier le poney : {{ $poney->nom }}</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('poneys.update', $poney->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nom">Nom du poney</label>
                <input type="text" class="form-control" id="nom" name="nom" value="{{ $poney->nom }}" required>
            </div>

            <div class="form-group">
                <label for="heures_travail_effectuee">Heures de travail effectuées</label>
                <input type="number" class="form-control" id="heures_travail_effectuee" name="heures_travail_effectuee"
                       value="{{ $poney->heures_travail_effectuee }}" required>
            </div>

            <div class="form-group">
                <label for="disponible">Disponible</label>
                <input type="checkbox" id="disponible" name="disponible" value="1" {{ $poney->disponible ? 'checked' : '' }}>
            </div>

            <button type="submit" class="btn btn-primary">Mettre à jour</button>
            <a href="{{ route('poneys.index') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
@endsection
