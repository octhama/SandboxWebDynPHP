<?php
session_start(); // Démarrer la session pour stocker le mode
include 'script/functions.php';

$todos = getTodos(); // Récupérer les tâches existantes pour les afficher
$categories = getCategories(); // Récupérer les catégories existantes pour les options de sélection
$selectedProgress = isset($_POST['newProgress']) ? intval($_POST['newProgress']) : 0;

// Permet de filtrer les tâches en fonction de la catégorie, de la priorité et de la progression
$filterCategory = $_GET['category'] ?? '';
$filterPriority = $_GET['priority'] ?? '';
$filterProgress = $_GET['progress'] ?? '';

// Filtrage des tâches en fonction des critères sélectionnés
if (!empty($filterCategory)) {
    $todos = array_filter($todos, function ($todo) use ($filterCategory) {
        return $todo['category'] === $filterCategory;
    });
}
if (!empty($filterPriority)) {
    $todos = array_filter($todos, function ($todo) use ($filterPriority) {
        return $todo['priority'] === $filterPriority;
    });
}
if (!empty($filterProgress)) {
    $todos = array_filter($todos, function ($todo) use ($filterProgress) {
        return $todo['progress'] === $filterProgress;
    });
}

if (isset($_GET['mode'])) {
    $mode = $_GET['mode'];
    $_SESSION['mode'] = $mode;
} else {
    $mode = $_SESSION['mode'] ?? 'jour';
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>ToDoList - Liste de tâches</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
    <?php if ($mode === 'nuit'): ?>
        <link rel="stylesheet" href="css/jour_nuit.css">
    <?php endif; ?>
</head>
<body class="<?php echo $mode; ?>">
<?php include 'views/layout/navbar.php'; ?>
<div class="container my-4">
    <form action="add.php" method="post" class="mb-3 p-3 border rounded">
        <div class="row g-3">
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <input type="text" id="newTask" name="newTask" class="form-control" placeholder="Nouvelle tâche" required>
                    <label for="newTask">Nouvelle tâche</label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-floating mb-3">
                    <input type="date" id="newDate" name="newDate" class="form-control">
                    <label for="newDate">Date</label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-floating mb-3">
                    <input type="time" id="newTime" name="newTime" class="form-control">
                    <label for="newTime">Heure</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-floating mb-3">
                    <select name="newPriority" class="form-select" id="newPriority">
                        <?php echo getPriorityOptions(1); ?>
                    </select>
                    <label for="newPriority">Priorité</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-floating mb-3">
                    <select name="newProgress" class="form-select" id="newProgress">
                        <?php echo getProgressOptions(0); ?>
                    </select>
                    <label for="newProgress">Progression</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-floating mb-3">
                    <select name="newCategory[]" class="form-select" id="newCategory">
                        <?php echo getCategoryOptions(''); ?>
                    </select>
                    <label for="newCategory">Catégorie</label>
                </div>
            </div>
            <div class="col-12">
                <div class="form-floating mb-3">
                    <input type="text" id="newCustomCategory" name="newCustomCategory" class="form-control"
                           placeholder="Catégorie perso.">
                    <label for="newCustomCategory">Catégorie perso.</label>
                </div>
            </div>
            <input type="hidden" name="category" value="<?php echo htmlspecialchars($filterCategory); ?>">
            <input type="hidden" name="priority" value="<?php echo htmlspecialchars($filterPriority); ?>">
            <input type="hidden" name="progress" value="<?php echo htmlspecialchars($filterProgress); ?>">
            <div class="col-4">
                <button type="submit" class="btn btn-primary w-20"><i class="bi bi-plus-square-dotted"></i></button>
            </div>
        </div>
    </form>

    <!-- Formulaire de filtrage -->
    <form method="get" class="mb-4">
        <div class="row g-3">
            <div class="col-md-4">
                <label for="categoryFilter" class="form-label">Filtrer par Catégorie :</label>
                <select class="form-select" id="categoryFilter" name="category">
                    <option value="">Toutes les catégories</option>
                    <?php foreach (getCategories() as $category): ?>
                        <option value="<?php echo htmlspecialchars($category); ?>" <?php if ($filterCategory === $category) echo 'selected'; ?>>
                            <?php echo htmlspecialchars($category); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-4">
                <label for="priorityFilter" class="form-label">Filtrer par Priorité :</label>
                <select class="form-select" id="priorityFilter" name="priority">
                    <option value="">Toutes les priorités</option>
                    <?php for ($i = 1; $i <= 10; $i++): ?>
                        <option value="<?php echo $i; ?>" <?php if ($filterPriority == $i) echo 'selected'; ?>>
                            <?php echo $i; ?>
                        </option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="col-md-4 align-self-end">
                <button type="submit" class="btn btn-primary w-20"><i class="bi bi-funnel"></i></button>
            </div>
        </div>
    </form>

    <h1 class="mb-4">Liste de tâches</h1>

    <?php if (count($todos) > 0): ?>
        <div class="row row-cols-1 row-cols-md-2 g-4">
            <?php foreach ($todos as $todo): ?>
                <div class="col">
                    <div class="card <?php echo $todo['completed'] || $todo['progress'] == 100 ? 'border-success' : ''; ?>">
                        <div class="card-body">
                            <h5 class="card-title">
                                <?php if ($todo['completed'] || $todo['progress'] == 100): ?>
                                    <span class="text-decoration-line-through text-danger">
                                        <?php echo htmlspecialchars($todo['task'] ?? ''); ?>
                                    </span>
                                <?php else: ?>
                                    <?php echo htmlspecialchars($todo['task'] ?? ''); ?>
                                <?php endif; ?>
                            </h5>
                            <p class="card-text">
                                <i class="bi bi-calendar"></i> <?php echo htmlspecialchars($todo['date'] ?? ''); ?><br>
                                <i class="bi bi-clock"></i> <?php if (!empty($todo['time'])) {
                                    echo htmlspecialchars(date('h:i A', strtotime($todo['time'])));
                                } else {
                                    echo 'Aucune heure spécifiée';
                                } ?><br>
                            </p>
                            <p class="card-text">
                                <?php
                                $todoCategories = explode(',', $todo['category'] ?? '');
                                foreach ($todoCategories as $category) {
                                    echo getCategoryBadge($category);
                                }
                                ?>
                            </p>
                            <p class="card-text">
                                <?php echo getPriorityBadge($todo['priority'] ?? ''); ?>
                            </p>

                            <?php
                            if ($todo['progress'] == 0) {
                                echo '<p class="text-muted">Non commencé</p>';
                            } elseif ($todo['progress'] == 100) {
                                echo '<p class="text-success">Accompli</p>';
                            } else {
                                $progress = $todo['progress'] ?? 0;
                                $progressClass = 'bg-danger';
                                if ($progress > 25) $progressClass = 'bg-warning';
                                if ($progress > 50) $progressClass = 'bg-info';
                                if ($progress > 75) $progressClass = 'bg-success';
                                echo '<div class="progress mb-2">
                                      <div class="progress-bar ' . $progressClass . '" role="progressbar" style="width: ' . $progress . '%" aria-valuenow="' . $progress . '" aria-valuemin="0" aria-valuemax="100">' . $progress . '%</div>
                                      </div>';
                            } ?>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="form-check form-switch">
                                    <form action="toggle.php" method="POST">
                                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($todo['id']); ?>">
                                        <input class="form-check-input" type="checkbox" role="switch"
                                               id="flexSwitchCheck<?php echo htmlspecialchars($todo['id']); ?>"
                                               name="completed"
                                            <?php echo $todo['completed'] || $todo['progress'] == 100 ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="flexSwitchCheck<?php echo htmlspecialchars($todo['id']); ?>">
                                            <?php echo $todo['completed'] || $todo['progress'] == 100 ? 'Terminé' : 'Non terminé'; ?>
                                        </label>
                                        <input type="hidden" name="category" value="<?php echo htmlspecialchars($filterCategory); ?>">
                                        <input type="hidden" name="priority" value="<?php echo htmlspecialchars($filterPriority); ?>">
                                        <input type="hidden" name="progress" value="<?php echo htmlspecialchars($filterProgress); ?>">
                                    </form>
                                </div>
                                <div class="btn-group" role="group">
                                    <a href="edit.php?id=<?php echo urlencode($todo['id']); ?>&category=<?php echo htmlspecialchars($filterCategory); ?>&priority=<?php echo htmlspecialchars($filterPriority); ?>&progress=<?php echo htmlspecialchars($filterProgress); ?>" class="btn btn-warning">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <a href="delete.php?id=<?php echo urlencode($todo['id']); ?>&category=<?php echo htmlspecialchars($filterCategory); ?>&priority=<?php echo htmlspecialchars($filterPriority); ?>&progress=<?php echo htmlspecialchars($filterProgress); ?>" class="btn btn-danger">
                                        <i class="bi bi-trash2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p class="alert alert-info">Aucune tâche n'est présente dans la liste.</p>
    <?php endif; ?>
</div>
<?php include 'views/layout/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
</body>
</html>
