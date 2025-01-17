<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .menu-card {
            min-height: 270px; /* Hauteur uniforme */
            max-height: 270px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            overflow: hidden; /* Empêche le débordement */
        }
        .menu-card i {
            font-size: 3rem;
        }
        .menu-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
<!-- Main Menu Section -->
<div class="container my-5">
    <h2 class="text-center mb-4">Navigation principale</h2>
    <div class="row g-4">
        <!-- Clients -->
        <div class="col-md-4">
            <div class="card menu-card shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-users text-primary"></i>
                    <h5 class="card-title">Gestion des Clients</h5>
                    <p class="card-text">Consultez, modifiez ou ajoutez des clients rapidement.</p>
                    <a href="{{ route('clients.index') }}" class="btn btn-primary">Accéder</a>
                </div>
            </div>
        </div>

        <!-- Rendez-vous -->
        <div class="col-md-4">
            <div class="card menu-card shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-calendar-alt text-success"></i>
                    <h5 class="card-title">Gestion des Rendez-vous</h5>
                    <p class="card-text">Planifiez et gérez vos rendez-vous efficacement.</p>
                    <a href="{{ route('rendezvous.index') }}" class="btn btn-success">Accéder</a>
                </div>
            </div>
        </div>

        <!-- Poneys -->
        <div class="col-md-4">
            <div class="card menu-card shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-horse text-warning"></i>
                    <h5 class="card-title">Gestion des Poneys</h5>
                    <p class="card-text">Ajoutez et suivez vos poneys pour vos activités.</p>
                    <a href="{{ route('poneys.index') }}" class="btn btn-warning">Accéder</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional Menus -->
    <div class="row g-4 mt-3">
        <!-- Rapports -->
        <div class="col-md-4">
            <div class="card menu-card shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-chart-line text-info"></i>
                    <h5 class="card-title">Rapports et Statistiques</h5>
                    <p class="card-text">Analysez vos données grâce à des rapports détaillés.</p>
                    <a href="{{ route('rapports.index') }}" class="btn btn-info">Accéder</a>
                </div>
            </div>
        </div>

        <!-- Paramètres -->
        <div class="col-md-4">
            <div class="card menu-card shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-cogs text-secondary"></i>
                    <h5 class="card-title">Paramètres</h5>
                    <p class="card-text">Configurez votre application selon vos besoins.</p>
                    <a href="{{ route('settings.index') }}" class="btn btn-secondary">Accéder</a>
                </div>
            </div>
        </div>

        <!-- Support -->
        <div class="col-md-4">
            <div class="card menu-card shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-life-ring text-danger"></i>
                    <h5 class="card-title">Support</h5>
                    <p class="card-text">Contactez-nous pour toute assistance technique.</p>
                    <a href="{{ route('support.index') }}" class="btn btn-danger">Accéder</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="text-center py-4 mt-5 bg-light">
    <p class="mb-0">&copy; 2025 Gestion Poney. Tous droits réservés.</p>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
