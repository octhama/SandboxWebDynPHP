@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Gestion des poneys</h1>

        <div class="row">
            <!-- Historique des factures -->
            <div class="col-md-6">
                <h2>Historique</h2>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Mois</th>
                        <th>Montant Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($historique as $mois => $montant)
                        <tr>
                            <td>{{ $mois }}</td>
                            <td>{{ number_format($montant, 2, ',', ' ') }} €</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <h3>Clients par mois</h3>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Nom du client</th>
                        <th>Montant</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($clientsMoisPrecedent as $client)
                        <tr>
                            <td>{{ $client->nom }}</td>
                            <td>{{ number_format($client->montant, 2, ',', ' ') }} €</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Mois en cours -->
            <div class="col-md-6">
                <h2>Mois en cours</h2>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Nom du client</th>
                        <th>Nombre de jours</th>
                        <th>Montant à payer</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($facturesMoisEnCours as $facture)
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
                        <th>{{ number_format($totalMoisEnCours, 2, ',', ' ') }} €</th>
                    </tr>
                    </tfoot>
                </table>
                <button class="btn btn-primary" onclick="envoyerFactures()">Envoyer toutes les factures</button>
            </div>
        </div>
    </div>
@endsection

<script>
    function envoyerFactures() {
        if (confirm('Êtes-vous sûr de vouloir envoyer toutes les factures ?')) {
            // Rediriger vers une route pour envoyer les factures
            window.location.href = "{{ route('factures.envoyer') }}";
        }
    }
</script>
