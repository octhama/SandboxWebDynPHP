<?php
include 'script/functions.php';
$todos = getTodos();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste de tâches</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <h1>Liste de tâches</h1>

    <form action="add.php" method="post" class="mb-3">
        <div class="input-group">
            <label for="newTask"></label><input type="text" id="newTask" name="newTask" class="form-control me-2" placeholder="Nouvelle tâche" required>
            <label for="newDate"></label><input type="date" id="newDate" name="newDate" class="form-control me-2" required>
            <label for="newTime"></label><input type="time" id="newTime" name="newTime" class="form-control me-2" required>
            <button type="submit" class="btn btn-primary" id="liveToastBtn">Ajouter</button>
        </div>
    </form>

    <?php if (count($todos) > 0): ?>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Tâche</th>
                <th scope="col">Date</th>
                <th scope="col">Heure</th>
                <th scope="col">Terminée</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($todos as $todo): ?>
                <tr>
                    <td><?php echo htmlspecialchars($todo['task']); ?></td>
                    <td>
                        <label>
                            <input type="date" class="form-control" value="<?php echo htmlspecialchars($todo['date']); ?>" readonly>
                        </label>
                    </td>
                    <td>
                        <label>
                            <input type="time" class="form-control" value="<?php echo htmlspecialchars($todo['time']); ?>" readonly>
                        </label>
                    </td>
                    <td>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheck<?php echo $todo['id']; ?>" <?php echo $todo['completed'] ? 'checked' : ''; ?> onclick="location.href='toggle.php?id=<?php echo urlencode($todo['id']); ?>'">
                            <label class="form-check-label" for="flexSwitchCheck<?php echo $todo['id']; ?>"><?php echo $todo['completed'] ? 'Oui' : 'Non'; ?></label>
                        </div>
                    </td>
                    <td>
                        <a href="edit.php?id=<?php echo urlencode($todo['id']); ?>" class="btn btn-warning rounded-pill px-1">Modifier</a>
                        <a href="delete.php?id=<?php echo urlencode($todo['id']); ?>" class="btn btn-danger rounded-pill px-1">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="alert alert-info">Aucune tâche n'est présente dans la liste.</p>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
