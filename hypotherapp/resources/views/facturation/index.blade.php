@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="mb-4">{{ ucfirst(\Carbon\Carbon::now()->isoFormat('dddd D MMMM YYYY')) }}</h3>

        <h2 class="text-center mb-4 fw-bold">Facturation</h2>

        <div class="row">
            <!-- Colonne Historique des facturations -->
            <div class="col-md-4">
                <h4 class="mb-3">Historique</h4>
                <ul class="list-group shadow-sm">
                    @foreach ($facturations->groupBy(fn($facture) => \Carbon\Carbon::parse($facture->created_at)->format('Y-m')) as $mois => $factures)
                        <li class="list-group-item d-flex justify-content-between align-items-center bg-light">
                            <a class="text-decoration-none w-100 d-flex align-items-center justify-content-between text-dark fw-semibold"
                               data-bs-toggle="collapse" href="#facture-{{ $loop->index }}" role="button"
                               aria-expanded="false" aria-controls="facture-{{ $loop->index }}">
                                <span>
                                    <i class="fas fa-chevron-right me-2 transition-icon"></i>
                                    {{ \Carbon\Carbon::createFromFormat('Y-m', $mois)->translatedFormat('F Y') }}
                                </span>
                                <span class="badge bg-primary p-2 fs-6">
                                    {{ number_format($factures->sum('montant'), 2, ',', ' ') }} €
                                </span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Colonne Détails de facturation -->
            <div class="col-md-8">
                <h4 class="mb-3">Détails</h4>
                <div>
                    @foreach ($facturations->groupBy(fn($facture) => \Carbon\Carbon::parse($facture->created_at)->format('Y-m')) as $mois => $factures)
                        <div class="collapse mt-2 bg-white p-3 rounded shadow-sm" id="facture-{{ $loop->index }}" data-bs-parent=".col-md-8">
                            <h5 class="fw-bold text-primary">{{ \Carbon\Carbon::parse($mois)->translatedFormat('F Y') }}</h5>
                            <table class="table table-hover">
                                <thead class="bg-primary text-white">
                                <tr>
                                    <th>Client</th>
                                    <th>Heures</th>
                                    <th>Montant (€)</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($factures as $facture)
                                    <tr class="align-middle">
                                        <td>{{ $facture->client ? $facture->client->nom : 'Client inconnu' }}</td>
                                        <td>{{ $facture->nombre_heures }}</td>
                                        <td class="fw-bold">{{ number_format($facture->montant, 2, ',', ' ') }} €</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <button class="btn btn-primary w-100 shadow-sm">
                                <i class="fas fa-paper-plane"></i> Envoyer les factures
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Icônes animées */
        .transition-icon {
            transition: transform 0.3s ease-in-out;
        }

        /* Rotation de l'icône au clic */
        .collapsed .transition-icon {
            transform: rotate(0deg);
        }

        .show .transition-icon {
            transform: rotate(90deg);
        }

        /* Animation sur la liste */
        .list-group-item:hover {
            background: #f8f9fa;
            transition: background 0.3s ease-in-out;
        }

        /* Ombre sur tableau */
        .table-hover tbody tr:hover {
            background: rgba(0, 123, 255, 0.1);
        }

        /* Effet de survol bouton */
        .btn-primary:hover {
            background: #0056b3;
            transform: translateY(-2px);
            transition: all 0.2s ease-in-out;
        }
    </style>

@endsection
