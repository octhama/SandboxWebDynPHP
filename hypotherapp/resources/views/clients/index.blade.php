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
                            <a href="{{ route('clients.show', $client->id) }}" class="btn btn-info btn-sm" title="Voir">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-warning btn-sm" title="Modifier">
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
        /* Style pour les boutons */
        .btn-info, .btn-warning, .btn-danger {
            transition: all 0.3s ease;
        }
        .btn-info:hover {
            background-color: #117a8b;
            border-color: #117a8b;
        }
        .btn-warning:hover {
            background-color: #d39e00;
            border-color: #c69500;
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
