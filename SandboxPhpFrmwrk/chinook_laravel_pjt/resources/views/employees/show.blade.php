@extends('layouts.app')

@section('title', 'Détails de l\'employé')

@section('content')
    <div class="container my-4">
        <h1>Détails de l'employé</h1>
        <ul class="list-group">
            <li class="list-group-item"><strong>Nom :</strong> {{ $employee->LastName }}</li>
            <li class="list-group-item"><strong>Prénom :</strong> {{ $employee->FirstName }}</li>
            <li class="list-group-item"><strong>Titre :</strong> {{ $employee->Title }}</li>
            <li class="list-group-item"><strong>Date de naissance :</strong> {{ $employee->BirthDate ? \Carbon\Carbon::parse($employee->BirthDate)->format('d/m/Y') : '-' }}</li>
            <li class="list-group-item"><strong>Pays :</strong> {{ $employee->Country }}</li>
        </ul>
        <div class="mt-3">
            <a href="{{ route('employees.edit', $employee->EmployeeId) }}" class="btn btn-warning">Modifier</a>
            <form action="{{ route('employees.destroy', $employee->EmployeeId) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr ?')">Supprimer</button>
            </form>
            <a href="{{ route('employees.index') }}" class="btn btn-secondary">Retour</a>
        </div>
    </div>
@endsection
