<?php
session_start(); // Démarrer la session pour stocker le mode
include 'script/functions.php';
$deletedTodos = getDeletedTodos();

// Gestion de la suppression définitive
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm_delete_id'])) {
    $deleteId = $_POST['confirm_delete_id'];
    deleteTodoPermanently($deleteId);
    // Rafraîchir la page pour mettre à jour la liste des tâches supprimées
    header('Location: corbeille.php');
    exit;
}
// Vérifiez si une demande de changement de mode a été faite
if (isset($_GET['mode'])) {
    $mode = $_GET['mode'];
    $_SESSION['mode'] = $mode; // Enregistrez le mode dans la session
} else {
    $mode = $_SESSION['mode'] ?? 'jour'; // Mode par défaut est 'jour'
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Corbeille</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
    <?php if ($mode === 'nuit'): ?>
        <link rel="stylesheet" href="css/jour_nuit.css">
    <?php endif; ?>
</head>
<body class="<?php echo $mode; ?>">
<?php include 'views/layout/navbar.php'; ?>
<div class="container">
    <h1>Corbeille</h1>

    <?php if (count($deletedTodos) > 0): ?>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Tâche</th>
                <th scope="col">Date</th>
                <th scope="col">Heure</th>
                <th scope="col">Catégorie</th>
                <th scope="col">Priorité</th>
                <th scope="col">Niveau de progression</th>
                <th scope="col">Statut</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($deletedTodos as $todo): ?>
                <tr>
                    <td>
                        <?php if ($todo['completed']): ?>
                            <s><?php echo htmlspecialchars($todo['task']); ?></s>
                        <?php else: ?>
                            <?php echo htmlspecialchars($todo['task']); ?>
                        <?php endif; ?>
                    </td>
                    <td><?php echo htmlspecialchars($todo['date']); ?></td>
                    <td><?php echo htmlspecialchars($todo['time']); ?></td>
                    <td><?php echo htmlspecialchars($todo['category']); ?></td>
                    <td><?php echo htmlspecialchars($todo['priority']); ?></td>
                    <td>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: <?php echo htmlspecialchars($todo['progress']); ?>%" aria-valuenow="<?php echo htmlspecialchars($todo['progress']); ?>" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </td>
                    <td><?php echo $todo['completed'] ? 'Terminé' : 'Non terminé'; ?></td>
                    <td>
                        <a href="restore.php?id=<?php echo urlencode($todo['id']); ?>" class="btn btn-success">Restaurer</a>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">Supprimer</button>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="alert alert-info">Aucune tâche supprimée.</p>
    <?php endif; ?>
</div>
<?php include 'views/layout/footer.php'; ?>

<!-- Modal de confirmation -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmer la suppression</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Êtes-vous sûr de vouloir supprimer définitivement cette tâche ?
            </div>
            <div class="modal-footer">
                <form method="post">
                    <input type="hidden" name="confirm_delete_id" id="confirmDeleteId">
                    <a href="delete_forever.php?id=<?php echo urlencode($todo['id']); ?>" class="btn btn-danger">Supprimer définitivement</a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
</body>
</html>
