<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <title>@yield('title', 'Hypotheapp - Gestion des Poneys')</title>
    <style>
        /* Arrière-plan avec dégradé doux */
        body {
            background: linear-gradient(135deg, #f3f4f6, #e5e6e8);
            font-family: 'Arial', sans-serif;
            color: #2c3e50;
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
            margin: 1rem auto; /* Centrage et marge */
            border-radius: 12px; /* Bordure arrondie */
            width: 90%; /* Largeur réduite */
            max-width: 1200px; /* Largeur maximale */
        }
        .navbar .nav-link {
            color: #2c3e50 !important;
            font-weight: 500;
            transition: color 0.3s ease, transform 0.2s ease;
        }
        .navbar .nav-link:hover {
            color: #6c5ce7 !important; /* Violet doux */
            transform: translateY(-2px);
        }
        .navbar-brand {
            color: #6c5ce7 !important; /* Violet doux */
            font-weight: bold;
            font-size: 1.5rem;
        }
        .navbar-toggler-icon {
            background-color: #2c3e50; /* Icône toggle */
        }

        /* Contenu principal */
        .container {
            flex: 1;
            padding: 2rem 0;
            animation: fadeIn 1s ease;
            width: 90%; /* Largeur réduite */
            max-width: 1200px; /* Largeur maximale */
            margin: 0 auto; /* Centrage */
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Cartes */
        .card {
            border: none;
            border-radius: 12px;
            background: #ffffff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        /* Footer Styling */
        footer {
            background: #ffffff;
            color: #2c3e50;
            border-top: 1px solid #e5e6e8;
            padding: 1.5rem;
            margin: 1rem auto 0; /* Centrage et marge */
            border-radius: 12px; /* Bordure arrondie */
            width: 90%; /* Largeur réduite */
            max-width: 1200px; /* Largeur maximale */
        }
        footer a {
            color: #6c5ce7; /* Violet doux */
            text-decoration: none;
            transition: color 0.3s ease;
        }
        footer a:hover {
            color: #5a4acf; /* Violet plus foncé */
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .navbar, .container, footer {
                width: 95%; /* Largeur légèrement réduite pour les petits écrans */
            }
            .navbar-brand {
                font-size: 1.2rem; /* Taille de police réduite */
            }
        }
    </style>
</head>
<body>
<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Hypotheapp</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('welcome') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('clients.index') }}">Clients</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('rendezvous.index') }}">Rendez-vous</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('poneys.index') }}">Poneys</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('settings.index') }}">Paramètres</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('support.index') }}">Support</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Main Content -->
<div class="container my-5">
    @yield('content')
</div>

<!-- Footer -->
<footer class="text-center py-4">
    <div class="container">
        <p class="mb-2">&copy; 2025 Hypotheapp - Gestion des Poneys. Tous droits réservés.</p>
        <p class="mb-0">
            <a href="#">Politique de confidentialité</a> |
            <a href="#">Conditions d'utilisation</a>
        </p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
