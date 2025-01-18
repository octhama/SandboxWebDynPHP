<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <title>@yield('title', 'Hypotherapp - Gestion des Poneys')</title>
    <style>
        /* Navigation Bar Styling */
        .navbar {
            background: linear-gradient(90deg, #6a11cb, #2575fc);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        .navbar .nav-link {
            color: #fff !important;
            transition: color 0.3s ease, transform 0.3s ease;
        }
        .navbar .nav-link:hover {
            color: #ffce00 !important;
            transform: scale(1.1);
        }
        .navbar-brand {
            color: #fff !important;
            font-weight: bold;
        }

        /* Footer Styling */
        footer {
            background: #343a40;
            color: #f8f9fa;
        }
        footer a {
            color: #ffce00;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        footer a:hover {
            color: #f8f9fa;
        }

        /* Background Animation */
        body {
            background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
            animation: gradientBG 15s ease infinite;
            background-size: 400% 400%;
        }
        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Container Styling */
        .container {
            animation: fadeIn 1.5s ease;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>
</head>
<body>
<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="#">Hypotherapp</a>
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
        <p class="mb-2">&copy; 2025 Hypotherapp - Gestion des Poneys. Tous droits réservés.</p>
        <p class="mb-0">
            <a href="#">Politique de confidentialité</a> |
            <a href="#">Conditions d'utilisation</a>
        </p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
