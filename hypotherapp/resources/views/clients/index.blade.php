@extends('layouts.app')

@section('content')
    <h1>Liste des Clients</h1>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <table>
        <thead>
        <tr>
            <th>Nom</th>
            <th>Nombre de personnes</th>
            <th>Heures</th>
            <th>Prix</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($clients as $client)
            <tr>
                <td>{{ $client->nom }}</td>
                <td>{{ $client->nombre_personnes }}</td>
                <td>{{ $client->heures }}</td>
                <td>{{ $client->prix }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
