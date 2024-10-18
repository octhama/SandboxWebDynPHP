<?php
require_once 'Db.php';
$db = new Db();

if (!empty($_GET['id'])) {
    $user = $db->find($_GET['id']);
    if (!$user) {
        header('Location: index.php'); // Si l'utilisateur n'existe pas, redirection
        exit();
    }
} else {
    header('Location: index.php');
    exit();
}

if (!empty($_POST['name']) && !empty($_POST['prenom']) && !empty($_POST['email'])) {
    // Mettre à jour l'utilisateur avec les nouvelles données
    $db->update([$_POST['name'], $_POST['prenom'], $_POST['email'], $_GET['id']]);
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang='fr'>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <title>DB - Modifier</title>
</head>
<body>
    <main class="container">
        <h1>ESA - CRUD</h1>
        <form action="edit.php?id=<?= htmlspecialchars($user->id) ?>" method="post">
            <label for="name">Nom</label>
            <input type="text" name="name" id="name" value="<?= htmlspecialchars($user->nom) ?>" required>
            <label for="prenom">Prénom</label>
            <input type="text" name="prenom" id="prenom" value="<?= htmlspecialchars($user->prenom) ?>" required>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="<?= htmlspecialchars($user->email) ?>" required>
            <button type="submit">Modifier</button>
        </form>
    </main>
</body>
</html>