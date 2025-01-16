@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Gestion des factures</h1>

        <!-- Liste des factures -->
        <ul>
            @foreach ($factures as $facture)
                <li>
                    Mois : {{ $facture->mois }}, Total : {{ $facture->total_recettes }} €
                </li>
            @endforeach
        </ul>
    </div>
@endsection
