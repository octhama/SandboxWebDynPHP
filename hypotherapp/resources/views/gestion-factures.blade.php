<!DOCTYPE html>
<html>
<head>
    <title>Gestion des Factures</title>
</head>
<body>
<h1>Gestion des Factures</h1>
@if(session('success'))
    <div>{{ session('success') }}</div>
@endif

<table>
    <thead>
    <tr>
        <th>#</th>
        <th>Client</th>
        <th>Montant</th>
        <th>Mois</th>
    </tr>
    </thead>
    <tbody>
    @forelse($factures as $facture)
        <tr>
            <td>{{ $facture->id }}</td>
            <td>{{ $facture->client->name ?? 'Inconnu' }}</td>
            <td>{{ $facture->montant }} €</td>
            <td>{{ $facture->mois }}</td>
        </tr>
    @empty
        <tr>
            <td colspan="4">Aucune facture disponible.</td>
        </tr>
    @endforelse
    </tbody>
</table>
</body>
</html>
