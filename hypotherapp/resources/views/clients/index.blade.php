@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-5">Liste des Clients</h1>

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Nombre de personnes</th>
                    <th>Heures</th>
                    <th>Prix total (€)</th>
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
                        <td>{{ number_format($client->prix_total, 2, ',', ' ') }}</td>
                        <td>
                            <!-- Boutons d'actions -->
                            <a href="{{ route('clients.show', $client->id) }}" class="btn btn-primary btn-sm" title="Voir">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-secondary btn-sm" title="Modifier">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('clients.destroy', $client->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm delete-btn" title="Supprimer">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Boîte de dialogue de confirmation -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteButtons = document.querySelectorAll('.delete-btn');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function (e) {
                    if (!confirm('Voulez-vous vraiment supprimer ce client ?')) {
                        e.preventDefault();
                    }
                });
            });
        });
    </script>

    <!-- Styles supplémentaires -->
    <style>

        /* Titres */
        h1, h2, h3, h4 {
            color: #2c3e50; /* Gris foncé */
            font-weight: 600;
        }

        /* Style pour les boutons */
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }
        .btn-secondary:hover {
            background-color: #545b62;
            border-color: #3d4349;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }

        /* Effet survol des lignes du tableau */
        .table-hover tbody tr:hover {
            background-color: rgba(0, 123, 255, 0.1);
        }
    </style>
@endsection
