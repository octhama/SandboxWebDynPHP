<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="assets/brand/Backlog.svg" alt="Bootstrap" width="60" height="48" class="d-inline-block align-text-top">
                ToDoList
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div id="navbarNav" class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto">
                </ul>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButtonDark" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-moon"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButtonDark">
                        <li>
                            <a class="dropdown-item" href="?mode=jour">
                                <i class="bi bi-sun"></i> Mode Jour
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="?mode=nuit">
                                <i class="bi bi-moon"></i> Mode Nuit
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="trash.php">
                                <i class="bi bi-trash"></i> Corbeille
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>
