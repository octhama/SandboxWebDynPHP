<?php
// Vérifier et définir le mode actuel
if (isset($_GET['mode'])) {
    $mode = $_GET['mode'];
} else {
    $mode = 'nuit';
}

// Inverser le mode si le bouton est cliqué
if (isset($_GET['toggle'])) {
    $mode = ($mode === 'jour') ? 'nuit' : 'jour';
}

// Déterminer les icônes en fonction du mode
$iconClass = ($mode === 'nuit') ? 'bi bi-moon-fill' : 'bi bi-sunrise';
?>

<header>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="assets/brand/Backlog.svg" alt="Bootstrap" width="30" height="24" class="d-inline-block align-text-top">
                ToDoList
            </a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="trash.php">
                            <i class="bi bi-trash"></i> Corbeille
                        </a>
                    </li>
                    <span class="navbar-text">
                            |
                    </span>
                    <li class="nav-item">
                        <a class="nav-link" href="?mode=<?php echo $mode; ?>&toggle=1">
                            <i class="<?php echo $iconClass; ?>"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
