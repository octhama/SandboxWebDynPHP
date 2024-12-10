@extends('layouts.app')

@section('title', 'Liste des employés')

@section('content')
    <div class="container my-4">
        <h1>Liste des employés</h1>
        <a href="{{ route('employees.create') }}" class="btn btn-success mb-3">Ajouter un employé</a>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nom</th>
                <th scope="col">Prénom</th>
                <th scope="col">Titre</th>
                <th scope="col">Date de naissance</th>
                <th scope="col">Pays</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody class="table-group-divider">
            @forelse ($employees as $employee)
                <tr>
                    <th scope="row">{{ $employee->EmployeeId }}</th>
                    <td>{{ $employee->LastName }}</td>
                    <td>{{ $employee->FirstName }}</td>
                    <td>{{ $employee->Title }}</td>
                    <td>{{ $employee->BirthDate ? \Carbon\Carbon::parse($employee->BirthDate)->format('d/m/Y') : '-' }}</td>
                    <td>{{ $employee->Country }}</td>
                    <td>
                        <a href="{{ route('employees.show', $employee->EmployeeId) }}" class="btn btn-info btn-sm">Voir</a>
                        <a href="{{ route('employees.edit', $employee->EmployeeId) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('employees.destroy', $employee->EmployeeId) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Aucun employé trouvé.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
