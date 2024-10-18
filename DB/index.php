<?php
require_once 'Db.php';
$db = new Db();
$users = $db->findAll();
?>
<!DOCTYPE html>
<html lang='fr'>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <title>DB - Page</title>
</head>
<body>
    <main class="container">
        <h1>ESA - CRUD</h1>
        <a href="create.php" role="button" class="outline">Créer</a>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= htmlspecialchars($user->id) ?></td>
                        <td><?= htmlspecialchars($user->nom) ?></td>
                        <td><?= htmlspecialchars($user->prenom) ?></td>
                        <td><?= htmlspecialchars($user->email) ?></td>
                        <td>
                            <a href="edit.php?id=<?= $user->id ?>" role="button" class="outline">Modifier</a>
                            <a href="delete.php?id=<?= $user->id ?>" role="button" class="outline">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</body>
</html>
