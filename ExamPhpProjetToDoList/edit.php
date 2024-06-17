<?php
include 'script/functions.php';

// Vérification et récupération de l'ID de la tâche à éditer
$currentTodo = null;
if (isset($_GET['id'])) {
    $todos = getTodos();
    foreach ($todos as $todo) {
        if ($todo['id'] == $_GET['id']) {
            $currentTodo = $todo;
            break;
        }
    }
    // Redirige si la tâche n'existe pas
    if (!$currentTodo) {
        header('Location: index.php');
        exit;
    }
} else {
    header('Location: index.php');
    exit;
}

// Traitement du formulaire lorsqu'il est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $task = trim($_POST['task']);
    $date = $_POST['date'] ?? '';
    $time = $_POST['time'] ?? '';
    $priority = (int)$_POST['priority'];
    $progress = (int)$_POST['progress'];
    $categories = $_POST['category'] ?? [];

    if (!empty($_POST['customCategory'])) {
        $categories[] = trim($_POST['customCategory']);
    }

    $categoryString = implode(',', $categories);

    // Vérification si la tâche n'est pas vide
    if (!empty($task)) {
        // Mise à jour des données de la tâche dans le tableau des todos
        foreach ($todos as &$todo) {
            if ($todo['id'] == $_GET['id']) {
                $todo['task'] = $task;
                $todo['date'] = $date;
                $todo['time'] = $time;
                $todo['priority'] = $priority;
                $todo['progress'] = $progress;
                $todo['category'] = $categoryString;
                break;
            }
        }
        unset($todo); // Détruire la référence

        // Sauvegarde des todos mis à jour
        saveTodos($todos);

        // Redirection après la mise à jour
        header('Location: index.php');
        exit;
    } else {
        // Redirige avec un message d'erreur si la tâche est vide
        header('Location: edit.php?id=' . urlencode($_GET['id']) . '&error=empty_task');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier la tâche</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
<?php include 'views/layout/navbar.php'; ?>
<div class="container">
    <h1>Modifier la tâche</h1>
    <?php if (isset($_GET['error']) && $_GET['error'] === 'empty_task'): ?>
        <div class="alert alert-danger" role="alert">
            La tâche ne peut pas être vide.
        </div>
    <?php endif; ?>
    <form action="edit.php?id=<?php echo urlencode($currentTodo['id']); ?>" method="post" class="mb-3">
        <div class="input-group">
            <input type="text" name="task" class="form-control me-2" value="<?php echo htmlspecialchars($currentTodo['task']); ?>" required>
            <input type="date" name="date" class="form-control me-2" value="<?php echo htmlspecialchars($currentTodo['date']); ?>">
            <input type="time" name="time" class="form-control me-2" value="<?php echo htmlspecialchars($currentTodo['time']); ?>">
            <select name="priority" class="form-select me-2">
                <?php echo getPriorityOptions($currentTodo['priority']); ?>
            </select>
            <select name="progress" class="form-select me-2">
                <?php echo getProgressOptions($currentTodo['progress']); ?>
            </select>
            <select name="category[]" class="form-select me-2">
                <?php echo getCategoryOptions(explode(',', $currentTodo['category'])); ?>
            </select>
            <input type="text" name="customCategory" class="form-control me-2" placeholder="Caté. perso.">
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </div>
    </form>
</div>
<?php include 'views/layout/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
</body>
</html>
