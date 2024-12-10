@extends('layouts.app')

@section('title', 'Liste des clients')

@section('content')
    <div class="container my-4">
        <h1>Liste des clients</h1>
        <a href="{{ route('customers.create') }}" class="btn btn-success mb-3">Ajouter un client</a>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Prénom</th>
                <th scope="col">Nom</th>
                <th scope="col">Email</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody class="table-group-divider">
            @forelse ($customers as $customer)
                <tr>
                    <th scope="row">{{ $customer->CustomerId }}</th>
                    <td>{{ $customer->FirstName }}</td>
                    <td>{{ $customer->LastName }}</td>
                    <td>{{ $customer->Email }}</td>
                    <td>
                        <a href="{{ route('customers.show', $customer->CustomerId) }}" class="btn btn-info btn-sm">Voir</a>
                        <a href="{{ route('customers.edit', $customer->CustomerId) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('customers.destroy', $customer->CustomerId) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce client ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Aucun client trouvé.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
