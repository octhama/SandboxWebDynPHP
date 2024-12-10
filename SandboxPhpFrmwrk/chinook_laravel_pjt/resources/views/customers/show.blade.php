@extends('layouts.app')

@section('title', 'Détails du client')

@section('content')
    <div class="container my-4">
        <h1>Détails du client</h1>
        <ul class="list-group">
            <li class="list-group-item"><strong>Prénom :</strong> {{ $customer->FirstName }}</li>
            <li class="list-group-item"><strong>Nom :</strong> {{ $customer->LastName }}</li>
            <li class="list-group-item"><strong>Email :</strong> {{ $customer->Email }}</li>
        </ul>
        <div class="mt-3">
            <a href="{{ route('customers.edit', $customer->CustomerId) }}" class="btn btn-warning">Modifier</a>
            <form action="{{ route('customers.destroy', $customer->CustomerId) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce client ?')">Supprimer</button>
            </form>
            <a href="{{ route('customers.index') }}" class="btn btn-secondary">Retour</a>
        </div>
    </div>
@endsection
