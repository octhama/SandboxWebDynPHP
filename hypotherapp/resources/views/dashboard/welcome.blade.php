<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hypotherapp - Welcome Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
            font-family: 'Poppins', sans-serif;
            color: #343a40;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            max-width: 1200px;
            text-align: center;
            animation: fadeIn 1s ease-in-out;
        }

        .menu-card {
            border-radius: 15px;
            background: #ffffff;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.4s ease, box-shadow 0.4s ease;
            overflow: hidden;
            position: relative;
        }

        .menu-card:hover {
            transform: scale(1.08);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .menu-card i {
            font-size: 3rem;
            margin-bottom: 10px;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
<div class="container">
    <!-- Afficher les messages d'alerte -->
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Inclure le composant d'alerte -->
    @include('components.alert')

    <h1>Bienvenue sur Hypotherapp</h1>
    <h2 class="mb-4">Navigation principale</h2>
    <div class="row g-4">
        <!-- Menus Principaux -->
        <div class="col-md-4">
            <div class="card menu-card text-center">
                <div class="card-body">
                    <i class="fas fa-users text-primary"></i>
                    <h5 class="card-title">Gestion des Clients</h5>
                    <p>Consultez, modifiez ou ajoutez des clients.</p>
                    <a href="{{ route('clients.index') }}" class="btn btn-primary">Accéder</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card menu-card text-center">
                <div class="card-body">
                    <i class="fas fa-calendar-alt text-success"></i>
                    <h5 class="card-title">Gestion des Rendez-vous</h5>
                    <p>Planifiez et gérez vos rendez-vous.</p>
                    <a href="{{ route('rendez-vous.index') }}" class="btn btn-success">Accéder</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card menu-card text-center">
                <div class="card-body">
                    <i class="fas fa-horse text-warning"></i>
                    <h5 class="card-title">Gestion des Poneys</h5>
                    <p>Ajoutez et suivez vos poneys.</p>
                    <a href="{{ route('poneys.index') }}" class="btn btn-warning">Accéder</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row g-4 mt-3">
        <!-- Menus Supplémentaires -->
        <div class="col-md-4">
            <div class="card menu-card text-center">
                <div class="card-body">
                    <i class="fas fa-chart-line text-info"></i>
                    <h5 class="card-title">Rapports et Statistiques</h5>
                    <p>Analysez vos données.</p>
                    <a href="{{ route('rapports.index') }}" class="btn btn-info">Accéder</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card menu-card text-center">
                <div class="card-body">
                    <i class="fas fa-cogs text-secondary"></i>
                    <h5 class="card-title">Paramètres</h5>
                    <p>Configurez votre application.</p>
                    <a href="{{ route('settings.index') }}" class="btn btn-secondary">Accéder</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card menu-card text-center">
                <div class="card-body">
                    <i class="fas fa-life-ring text-danger"></i>
                    <h5 class="card-title">Support</h5>
                    <p>Assistance technique.</p>
                    <a href="{{ route('support.index') }}" class="btn btn-danger">Accéder</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
