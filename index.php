<?php
$csv_file = 'todolist.csv';

function loadTasks() {
    global $csv_file;
    $tasks = [];
    if (($handle = fopen($csv_file, "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $tasks[] = $data;
        }
        fclose($handle);
    }
    return $tasks;
}

function saveTasks($tasks) {
    global $csv_file;
    $fp = fopen($csv_file, 'w');
    foreach ($tasks as $task) {
        fputcsv($fp, $task);
    }
    fclose($fp);
}

function sortTasks($tasks) {
    usort($tasks, function($a, $b) {
        if ($a[1] != $b[1]) {
            return $a[1] <=> $b[1];
        }
        if ($a[7] != $b[7]) {
            return $b[7] <=> $a[7];
        }
        return strtotime($a[5]) <=> strtotime($b[5]);
    });
    return $tasks;
}

$tasks = loadTasks();
$tasks = sortTasks($tasks);

$categories = array_unique(array_column($tasks, 8));
$priorities = ['low', 'medium', 'high'];

// Filtrage et recherche
$filter_category = $_GET['filter_category'] ?? '';
$filter_priority = $_GET['filter_priority'] ?? '';
$search = $_GET['search'] ?? '';

$filtered_tasks = array_filter($tasks, function($task) use ($filter_category, $filter_priority, $search) {
    $category_match = empty($filter_category) || $task[8] == $filter_category;
    $priority_match = empty($filter_priority) || $task[2] == $filter_priority;
    $search_match = empty($search) || stripos($task[0], $search) !== false;
    return $category_match && $priority_match && $search_match;
});

if (isset($_POST['add_task']) && !empty($_POST['task'])) {
    $tasks[] = [
        $_POST['task'],
        '',
        $_POST['priority'],
        $_POST['custom_badge'],
        $_POST['start_date'],
        $_POST['end_date'],
        $_POST['progress'],
        $_POST['weight'],
        $_POST['category']
    ];
    $tasks = sortTasks($tasks);
    saveTasks($tasks);
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}

if (isset($_POST['delete_task'])) {
    unset($tasks[$_POST['delete_task']]);
    $tasks = array_values($tasks);
    saveTasks($tasks);
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}

if (isset($_POST['edit_task'])) {
    $tasks[$_POST['edit_task']] = [
        $_POST['task_text'],
        $tasks[$_POST['edit_task']][1],
        $_POST['priority'],
        $_POST['custom_badge'],
        $_POST['start_date'],
        $_POST['end_date'],
        $_POST['progress'],
        $_POST['weight'],
        $_POST['category']
    ];
    $tasks = sortTasks($tasks);
    saveTasks($tasks);
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}

if (isset($_POST['toggle_task'])) {
    $tasks[$_POST['toggle_task']][1] = $tasks[$_POST['toggle_task']][1] ? '' : 'checked';
    $tasks = sortTasks($tasks);
    saveTasks($tasks);
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Todo List PHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Todo List</h1>

    <!-- Formulaire de filtrage et barre de recherche -->
    <form method="get" class="mb-4">
        <div class="row g-3">
            <div class="col-md-3">
                <select name="filter_category" class="form-select">
                    <option value="">Toutes les catégories</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo htmlspecialchars($category); ?>" <?php if($filter_category == $category) echo 'selected'; ?>>
                            <?php echo htmlspecialchars($category); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-3">
                <select name="filter_priority" class="form-select">
                    <option value="">Toutes les priorités</option>
                    <?php foreach ($priorities as $priority): ?>
                        <option value="<?php echo $priority; ?>" <?php if($filter_priority == $priority) echo 'selected'; ?>>
                            <?php echo ucfirst($priority); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Rechercher une tâche" value="<?php echo htmlspecialchars($search); ?>">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Filtrer</button>
            </div>
        </div>
    </form>

    <!-- Formulaire d'ajout de tâche -->
    <form method="post" class="mb-4">
        <div class="row g-3">
            <div class="col-md-3">
                <input type="text" name="task" class="form-control" placeholder="Nouvelle tâche" required>
            </div>
            <div class="col-md-2">
                <select name="priority" class="form-select">
                    <option value="low">Basse</option>
                    <option value="medium">Moyenne</option>
                    <option value="high">Haute</option>
                </select>
            </div>
            <div class="col-md-1">
                <input type="number" name="weight" class="form-control" placeholder="Poids" min="1" max="10" required>
            </div>
            <div class="col-md-2">
                <input type="text" name="category" class="form-control" placeholder="Catégorie" required>
            </div>
            <div class="col-md-2">
                <input type="date" name="start_date" class="form-control" required>
            </div>
            <div class="col-md-2">
                <input type="date" name="end_date" class="form-control" required>
            </div>
            <div class="col-md-2">
                <input type="text" name="custom_badge" class="form-control" placeholder="Badge personnalisé">
            </div>
            <div class="col-md-1">
                <input type="number" name="progress" class="form-control" placeholder="%" min="0" max="100" required>
            </div>
            <div class="col-12">
                <button type="submit" name="add_task" class="btn btn-success">Ajouter</button>
            </div>
        </div>
    </form>

    <!-- Affichage des tâches filtrées -->
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <?php foreach ($filtered_tasks as $index => $task): ?>
            <div class="col">
                <div class="card h-100 <?php echo $task[1] ? 'bg-light' : ''; ?>">
                    <div class="card-body">
                        <form method="post">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5 class="card-title">
                                    <input type="checkbox" name="toggle_task" value="<?php echo $index; ?>" <?php echo $task[1]; ?> onchange="this.form.submit()" class="form-check-input me-2">
                                    Tâche #<?php echo $index + 1; ?>
                                </h5>
                                <?php
                                $badge_class = 'bg-info';
                                if ($task[2] == 'low') $badge_class = 'bg-success';
                                if ($task[2] == 'high') $badge_class = 'bg-danger';
                                ?>
                                <span class="badge <?php echo $badge_class; ?>"><?php echo ucfirst($task[2]); ?></span>
                                <span class="badge bg-secondary">Poids: <?php echo $task[7]; ?></span>
                                <?php if (!empty($task[3])): ?>
                                    <span class="badge bg-primary"><?php echo htmlspecialchars($task[3]); ?></span>
                                <?php endif; ?>
                            </div>
                            <input type="text" name="task_text" value="<?php echo htmlspecialchars($task[0]); ?>" class="form-control mb-2">
                            <select name="priority" class="form-select mb-2">
                                <option value="low" <?php if($task[2] == 'low') echo 'selected'; ?>>Basse</option>
                                <option value="medium" <?php if($task[2] == 'medium') echo 'selected'; ?>>Moyenne</option>
                                <option value="high" <?php if($task[2] == 'high') echo 'selected'; ?>>Haute</option>
                            </select>
                            <input type="number" name="weight" value="<?php echo $task[7]; ?>" class="form-control mb-2" placeholder="Poids" min="1" max="10" required>
                            <input type="text" name="category" value="<?php echo htmlspecialchars($task[8]); ?>" class="form-control mb-2" placeholder="Catégorie" required>
                            <input type="text" name="custom_badge" value="<?php echo htmlspecialchars($task[3]); ?>" class="form-control mb-2" placeholder="Badge personnalisé">
                            <div class="row mb-2">
                                <div class="col">
                                    <input type="date" name="start_date" value="<?php echo $task[4]; ?>" class="form-control" required>
                                </div>
                                <div class="col">
                                    <input type="date" name="end_date" value="<?php echo $task[5]; ?>" class="form-control" required>
                                </div>
                            </div>
                            <div class="input-group mb-2">
                                <input type="number" name="progress" value="<?php echo $task[6]; ?>" class="form-control" placeholder="%" min="0" max="100" required>
                                <span class="input-group-text">%</span>
                            </div>
                            <div class="progress mb-2" style="height: 20px;">
                                <div class="progress-bar" role="progressbar" style="width: <?php echo $task[6]; ?>%;" aria-valuenow="<?php echo $task[6]; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $task[6]; ?>%</div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <button type="submit" name="edit_task" value="<?php echo $index; ?>" class="btn btn-secondary btn-sm">Éditer</button>
                                <button type="submit" name="delete_task" value="<?php echo $index; ?>" class="btn btn-danger btn-sm">Supprimer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</body>
</html>
