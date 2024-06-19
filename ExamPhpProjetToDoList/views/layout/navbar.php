<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">ToDo List</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div id="navbarNav" class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="trash.php"><i class="bi bi-trash"></i></a>
                    </li>
                </ul>
                <div class="dropdown" data-bs-theme="dark">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButtonDark" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-moon"></i>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonDark">
                        <li class="nav-item">
                            <a class="nav-link" href="?mode=jour">
                                <i class="bi bi-sun"></i> Mode Jour
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="?mode=nuit">
                                <i class="bi bi-moon"></i> Mode Nuit
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>

