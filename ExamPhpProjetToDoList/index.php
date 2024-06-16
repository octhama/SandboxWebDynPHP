<?php
include 'script/functions.php';
$todos = getTodos();
$categories = getCategories();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste de tâches</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
<?php include 'views/layout/navbar.php'; ?>
<div class="container">
    <h1>Liste de tâches</h1>

    <form action="add.php" method="post" class="mb-3">
        <div class="input-group">
            <input type="text" id="newTask" name="newTask" class="form-control me-2" placeholder="Nouvelle tâche" required>
            <input type="date" id="newDate" name="newDate" class="form-control me-2">
            <input type="time" id="newTime" name="newTime" class="form-control me-2">
            <select name="newPriority" class="form-select me-2">
                <?php echo getPriorityOptions(1); ?>
            </select>
            <select name="progress" class="form-select me-2">
                <?php
                $progressOptions = getProgress();
                foreach ($progressOptions as $label => $value) {
                    echo '<option value="' . $value . '">' . $label . '</option>';
                }
                ?>
            </select>
            <select name="newCategory[]" class="form-select me-2">
                <?php echo getCategoryOptions(''); ?>
            </select>
            <input type="text" id="newCustomCategory" name="newCustomCategory" class="form-control me-2" placeholder="Caté. perso.">
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </div>
    </form>

    <?php if (count($todos) > 0): ?>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Tâche</th>
                <th scope="col">Date</th>
                <th scope="col">Heure</th>
                <th scope="col">Catégorie</th>
                <th scope="col">Priorité</th>
                <th scope="col">Niveau de progression</th>
                <th scope="col">Terminée</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($todos as $todo): ?>
                <tr class="<?php echo $todo['completed'] ? 'text-decoration-line-through' : ''; ?>">
                    <td><?php echo htmlspecialchars($todo['task'] ?? ''); ?></td>
                    <td><?php echo htmlspecialchars($todo['date'] ?? ''); ?></td>
                    <td><?php echo htmlspecialchars($todo['time'] ?? ''); ?></td>
                    <td>
                        <?php
                        $todoCategories = explode(',', $todo['category'] ?? '');
                        foreach ($todoCategories as $category) {
                            echo getCategoryBadge($category);
                        }
                        ?>
                    </td>
                    <td><?php echo getPriorityBadge($todo['priority'] ?? ''); ?></td>
                    <td>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: <?php echo $todo['progress'] ?? 0; ?>%" aria-valuenow="<?php echo $todo['progress'] ?? 0; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </td>
                    <td>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheck<?php echo $todo['id']; ?>" <?php echo $todo['completed'] ? 'checked' : ''; ?> onclick="location.href='toggle.php?id=<?php echo urlencode($todo['id']); ?>'">
                            <label class="form-check-label" for="flexSwitchCheck<?php echo $todo['id']; ?>"><?php echo $todo['completed'] ? 'Oui' : 'Non'; ?></label>
                        </div>
                    </td>
                    <td>
                        <a href="edit.php?id=<?php echo urlencode($todo['id']); ?>" class="btn btn-warning">Modifier</a>
                        <a href="delete.php?id=<?php echo urlencode($todo['id']); ?>" class="btn btn-danger">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="alert alert-info">Aucune tâche n'est présente dans la liste.</p>
    <?php endif; ?>
</div>
<?php include 'views/layout/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
</body>
</html>
