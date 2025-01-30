<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facture - {{ $client->nom }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .invoice-container {
            width: 100%;
            max-width: 700px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .details {
            margin-bottom: 20px;
        }
        .details p {
            font-size: 16px;
            margin: 5px 0;
        }
        .total {
            font-size: 20px;
            font-weight: bold;
            text-align: right;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="invoice-container">
    <h1>Facture</h1>

    <div class="details">
        <p><strong>Client :</strong> {{ $client->nom }}</p>
        <p><strong>Nombre de personnes :</strong> {{ $client->nombre_personnes }}</p>
        <p><strong>Heures :</strong> {{ $client->heures }}</p>
        <p class="total"><strong>Total :</strong> {{ number_format($client->prix_total, 2, ',', ' ') }} €</p>
    </div>
</div>

</body>
</html>
