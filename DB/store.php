<?php
require_once 'Db.php'; // Inclure le fichier Db.php pour accéder à la classe Db (CRUD) (DB)
$db = new Db();

if (!empty($_POST['name']) && !empty($_POST['prenom']) && !empty($_POST['email'])) { // Vérifier si les champs du formulaire ne sont pas vides (validation côté serveur)
    // Enregistrer les données dans la base de données
    $db->store([$_POST['name'], $_POST['prenom'], $_POST['email']]); // Appeler la méthode store() de la classe Db avec les données du formulaire en tant que paramètre (CRUD)
    header('Location: index.php'); // Rediriger vers la page d'accueil après l'insertion des données dans la base de données SQLite (CRUD)
    exit();
} else {
    // Rediriger vers le formulaire s'il y a des champs vides (validation côté serveur)
    header('Location: create.php');
    exit();
}