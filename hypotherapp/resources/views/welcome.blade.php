<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hypotheapp - Welcome Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        /* Global Styling */
        body {
            background-color: #f8f9fa; /* Blanc cassé */
            font-family: 'Poppins', sans-serif;
            color: #343a40;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Navigation Bar Styling */
        .navbar {
            background: #ffffff; /* Fond blanc */
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 1rem;
            margin: 1rem auto;
            border-radius: 12px;
            width: 90%;
            max-width: 1200px;
        }
        .navbar .nav-link {
            color: #2c3e50 !important;
            font-weight: 500;
        }
        .navbar-brand {
            color: #6c5ce7 !important;
            font-weight: bold;
        }

        /* Main Container Styling */
        .container {
            flex: 1;
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Title Styling */
        h1, h2 {
            font-weight: 600;
            color: #2c3e50;
        }

        /* Cards Styling */
        .menu-card {
            border-radius: 15px;
            background: #ffffff;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .menu-card:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }
        .menu-card i {
            font-size: 3rem;
            margin-bottom: 10px;
        }

        /* Footer Styling */
        footer {
            text-align: center;
            padding: 20px 0;
            background: #ffffff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            color: #2c3e50;
            font-size: 0.9rem;
            margin-top: auto;
            width: 90%;
            max-width: 1200px;
            margin: 1rem auto 0;
            border-radius: 12px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .navbar, .container, footer {
                width: 95%;
            }
            .navbar-brand {
                font-size: 1.2rem;
            }
        }
    </style>
</head>
<body>

<!-- Main Menu Section -->
<div class="container my-3">
    <!-- Welcome Section -->
    <div class="container my-5">
        <h1 class="text-center">Bienvenue sur Hypotheapp</h1>
    </div>
    <h2 class="text-center mb-4">Navigation principale</h2>
    <div class="row g-4">
        <!-- Clients -->
        <div class="col-md-4">
            <div class="card menu-card text-center">
                <div class="card-body">
                    <i class="fas fa-users text-primary"></i>
                    <h5 class="card-title">Gestion des Clients</h5>
                    <p class="card-text">Consultez, modifiez ou ajoutez des clients rapidement.</p>
                    <a href="{{ route('clients.index') }}" class="btn btn-primary">Accéder</a>
                </div>
            </div>
        </div>
        <!-- Rendez-vous -->
        <div class="col-md-4">
            <div class="card menu-card text-center">
                <div class="card-body">
                    <i class="fas fa-calendar-alt text-success"></i>
                    <h5 class="card-title">Gestion des Rendez-vous</h5>
                    <p class="card-text">Planifiez et gérez vos rendez-vous efficacement.</p>
                    <a href="{{ route('rendezvous.index') }}" class="btn btn-success">Accéder</a>
                </div>
            </div>
        </div>
        <!-- Poneys -->
        <div class="col-md-4">
            <div class="card menu-card text-center">
                <div class="card-body">
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
            <div class="card menu-card text-center">
                <div class="card-body">
                    <i class="fas fa-chart-line text-info"></i>
                    <h5 class="card-title">Rapports et Statistiques</h5>
                    <p class="card-text">Analysez vos données grâce à des rapports détaillés.</p>
                    <a href="{{ route('rapports.index') }}" class="btn btn-info">Accéder</a>
                </div>
            </div>
        </div>
        <!-- Paramètres -->
        <div class="col-md-4">
            <div class="card menu-card text-center">
                <div class="card-body">
                    <i class="fas fa-cogs text-secondary"></i>
                    <h5 class="card-title">Paramètres</h5>
                    <p class="card-text">Configurez votre application selon vos besoins.</p>
                    <a href="{{ route('settings.index') }}" class="btn btn-secondary">Accéder</a>
                </div>
            </div>
        </div>
        <!-- Support -->
        <div class="col-md-4">
            <div class="card menu-card text-center">
                <div class="card-body">
                    <i class="fas fa-life-ring text-danger"></i>
                    <h5 class="card-title">Support</h5>
                    <p class="card-text">Contactez-nous pour toute assistance technique.</p>
                    <a href="{{ route('support.index') }}" class="btn btn-danger">Accéder</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
