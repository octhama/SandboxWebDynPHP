<header>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="assets/brand/Backlog.svg" alt="Bootstrap" width="30" height="24" class="d-inline-block align-text-top">
                ToDoList </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div id="navbarNav" class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto">
                </ul>
                <div class="dropdown">
                    <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-moon-stars"></i> <span>|</span> <i class="bi bi-trash3-fill"></i>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonDark">
                        <li>
                            <a class="dropdown-item" href="?mode=jour">
                                <i class="bi bi-sunrise"></i> Mode Jour
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="?mode=nuit">
                                <i class="bi bi-moon-fill"></i> Mode Nuit
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
