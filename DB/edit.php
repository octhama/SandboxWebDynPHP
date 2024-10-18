<?php
// Modifier un utilisateur dans la base de données SQLite (CRUD) (DB)

require_once 'Db.php'; // Inclure le fichier Db.php pour accéder à la classe Db (CRUD) (DB)
$db = new Db();

if (!empty($_GET['id'])) { // Vérifier si l'identifiant de l'utilisateur est défini dans l'URL
    $user = $db->find($_GET['id']); // Récupérer les données de l'utilisateur à modifier
} else {
    header('Location: index.php'); // Rediriger vers la page d'accueil si l'identifiant de l'utilisateur n'est pas défini dans l'URL
    exit();
}

if (!empty($_POST['name']) && !empty($_POST['prenom']) && !empty($_POST['email'])) { // Vérifier si les champs du formulaire ne sont pas vides (validation côté serveur)
    // Mettre à jour les données de l'utilisateur dans la base de données
    $db->update([$_POST['name'], $_POST['prenom'], $_POST['email'], $_GET['id']]); // Appeler la méthode update() de la classe Db avec les données du formulaire et l'identifiant de l'utilisateur en tant que paramètres (CRUD)
    header('Location: index.php'); // Rediriger vers la page d'accueil après la mise à jour des données de l'utilisateur dans la base de données SQLite (CRUD)
    exit();
}

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
        <form action="edit.php?id=<?= $user->id ?>" method="post">
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
