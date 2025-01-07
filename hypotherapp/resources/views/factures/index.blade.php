@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Gestion des Poneys</h1>
        <p><strong>Mercredi 2 Octobre 2024</strong></p>

        <!-- Section Historique -->
        <div class="row">
            <div class="col-md-6">
                <h3>Historique</h3>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Mois</th>
                        <th>Montant Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($historique as $item)
                        <tr>
                            <td>{{ $item->mois }}</td>
                            <td>{{ number_format($item->montant_total, 2, ',', ' ') }} €</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Section Mois en cours -->
            <div class="col-md-6">
                <h3>Mois en cours</h3>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Nom du client</th>
                        <th>Nombre de jours</th>
                        <th>Montant à payer</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($factures as $facture)
                        <tr>
                            <td>{{ $facture->client->nom }}</td>
                            <td>{{ $facture->nombre_jours }}</td>
                            <td>{{ number_format($facture->montant, 2, ',', ' ') }} €</td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th colspan="2">Total :</th>
                        <th>{{ number_format($total, 2, ',', ' ') }} €</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <!-- Bouton pour envoyer les factures -->
        <div class="text-end">
            <form action="{{ route('factures.envoyer') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">Envoyer toutes les factures</button>
            </form>
        </div>
    </div>
@endsection
