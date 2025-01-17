@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Détails du Client : {{ $client->nom }}</h1>
        <ul>
            <li><strong>Nombre de personnes :</strong> {{ $client->nombre_personnes }}</li>
            <li><strong>Heures :</strong> {{ $client->heures }}</li>
            <li><strong>Prix total :</strong> {{ $client->prix_total }} €</li>
        </ul>
        <a href="{{ route('clients.index') }}" class="btn btn-secondary">Retour à la liste des clients</a>
    </div>
@endsection
