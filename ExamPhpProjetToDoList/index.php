<?php
include 'script/functions.php';
$todos = getTodos(); // Récupérer les tâches existantes pour les afficher
$categories = getCategories(); // Récupérer les catégories existantes pour les options de sélection
// Vérifier si une valeur de progression a été soumise et la convertir en entier si elle est valide
$selectedProgress = isset($_POST['newProgress']) ? intval($_POST['newProgress']) : 0;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste de tâches</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
<?php include 'views/layout/navbar.php'; ?>
<div class="container">
    <h1>Liste de tâches</h1>

    <form action="add.php" method="post" class="mb-3">
        <div class="input-group">
            <input type="text" id="newTask" name="newTask" class="form-control me-2" placeholder="Nouvelle tâche"
                   required>
            <input type="date" id="newDate" name="newDate" class="form-control me-2">
            <input type="time" id="newTime" name="newTime" class="form-control me-2">
            <select name="newPriority" class="form-select me-2">
                <?php echo getPriorityOptions(1); ?>
            </select>
            <select name="newProgress" class="form-select me-2">
                <?php echo getProgressOptions(0); ?>
            </select>
            <select name="newCategory[]" class="form-select me-2">
                <?php echo getCategoryOptions(''); ?>
            </select>
            <input type="text" id="newCustomCategory" name="newCustomCategory" class="form-control me-2"
                   placeholder="Caté. perso.">
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

                <tr>
                    <!-- Ajout de la class CSS Bootstrap pour barrer le texte en rouge si la tâche est terminée -->
                    <td>
                        <?php if ($todo['completed']): ?>
                            <span class="text-decoration-line-through text-danger">
                                <?php echo htmlspecialchars($todo['task'] ?? ''); ?>
                            </span>
                        <?php else: ?>
                            <?php echo htmlspecialchars($todo['task'] ?? ''); ?>
                        <?php endif; ?>
                    </td>
                    <td><?php echo htmlspecialchars($todo['date'] ?? ''); ?></td> <!-- htmlspecialchars() est une fonction PHP qui convertit les caractères spéciaux en entités HTML pour éviter les problèmes de sécurité comme les attaques XSS -->
                    <td><?php echo htmlspecialchars($todo['time'] ?? ''); ?></td>
                    <td>
                        <?php
                        $todoCategories = explode(',', $todo['category'] ?? ''); // Les ?? sont utilisés pour éviter les erreurs si la clé n'existe pas dans le tableau
                        // PS : explode() divise une chaîne en un tableau de sous-chaînes en utilisant un délimiteur (, dans ce cas) c'est à dire que si la catégorie est "Travail, Personnel", le tableau sera ['Travail', 'Personnel']
                        // On affiche ensuite un badge pour chaque catégorie
                        foreach ($todoCategories as $category) {
                            echo getCategoryBadge($category);
                        }
                        ?>
                    </td>
                    <td><?php echo getPriorityBadge($todo['priority'] ?? ''); ?></td>
                    <td>
                        <div class="progress">
                            <?php
                            $progress = $todo['progress'] ?? 0;
                            $progressClass = '';
                            if ($progress <= 25) {
                                $progressClass = 'bg-danger';
                            } elseif ($progress <= 50) {
                                $progressClass = 'bg-warning';
                            } elseif ($progress <= 75) {
                                $progressClass = 'bg-info';
                            } else {
                                $progressClass = 'bg-success';
                            }
                            ?>
                            <div class="progress-bar <?php echo $progressClass; ?> progress-bar-striped"
                                 role="progressbar" style="width: <?php echo $progress; ?>%"
                                 aria-valuenow="<?php echo $progress; ?>" aria-valuemin="0" aria-valuemax="100">
                                <?php echo $progress; ?>%
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch"
                                   id="flexSwitchCheck<?php echo $todo['id']; ?>" <?php echo $todo['completed'] ? 'checked' : ''; ?>
                                   onclick="location.href='toggle.php?id=<?php echo urlencode($todo['id']); ?>'">
                            <label class="form-check-label"
                                   for="flexSwitchCheck<?php echo $todo['id']; ?>"><?php echo $todo['completed'] ? 'Oui' : 'Non'; ?></label>
                        </div>
                    </td>
                    <td>
                        <a href="edit.php?id=<?php echo urlencode($todo['id']); ?>" class="btn btn-warning">Modifier</a>
                        <a href="delete.php?id=<?php echo urlencode($todo['id']); ?>"
                           class="btn btn-danger">Supprimer</a>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
</body>
</html>
