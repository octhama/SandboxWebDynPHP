@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Liste des clients</h1>
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Nom</th>
                <th>Nombre de personnes</th>
                <th>Heures</th>
                <th>Prix total</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($clients as $client)
                <tr>
                    <td>{{ $client->id }}</td>
                    <td>{{ $client->nom }}</td>
                    <td>{{ $client->nombre_personnes }}</td>
                    <td>{{ $client->heures }}</td>
                    <td>{{ $client->prix_total }}</td>
                    <td>
                        <!-- Boutons d'actions -->
                        <a href="{{ route('clients.show', $client->id) }}" class="btn btn-info btn-sm">Voir</a>
                        <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('clients.destroy', $client->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
