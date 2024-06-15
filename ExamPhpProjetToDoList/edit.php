<?php
include 'script/functions.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    $id = '';
}

if (!empty($id)) {
    $todos = getTodos();
    $todo = null;

    foreach ($todos as $t) {
        if ($t['id'] === $id) {
            $todo = $t;
            break;
        }
    }

    if ($todo) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $task = trim($_POST['task']);
            if (!empty($task)) {
                editTodo($id, $task, $todo['date'], $todo['time']);
                header('Location: index.php');
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
        </head>
        <body>
        <div class="container">
            <h1>Modifier la tâche</h1>

            <?php if (true): ?>
                <form action="edit.php?id=<?php echo htmlspecialchars($id); ?>" method="post" class="mb-3">
                    <div class="mb-3">
                        <label for="task" class="form-label">Tâche:</label>
                        <input type="text" id="task" name="task" value="<?php echo htmlspecialchars($todo['task']); ?>" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">Date:</label>
                        <input type="date" id="date" name="date" value="<?php echo htmlspecialchars($todo['date']); ?>" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="time" class="form-label">Heure:</label>
                        <input type="time" id="time" name="time" value="<?php echo htmlspecialchars($todo['time']); ?>" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Modifier</button>
                    <button type="button" onclick="window.location.href = 'index.php';" class="btn btn-secondary">Annuler</button>
                </form>
            <?php else: ?>
                <p class="alert alert-danger">Erreur : Tâche introuvable.</p>
            <?php endif; ?>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        </body>
        </html>

        <?php
    } else {
        echo 'Erreur: Tâche introuvable.';
    }
} else {
    echo 'Erreur: Impossible de modifier la tâche.';
}
?>
