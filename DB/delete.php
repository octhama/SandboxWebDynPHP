<?php
// Supprimer un utilisateur de la base de données SQLite
require_once 'Db.php'; // Inclure le fichier Db.php pour accéder à la classe Db (CRUD) (DB)
$db = new Db();

if (!empty($_GET['id'])) { // Vérifier si l'identifiant de l'utilisateur est défini dans l'URL
    // Supprimer l'utilisateur de la base de données
    $db->delete($_GET['id']); // Appeler la méthode delete() de la classe Db avec l'identifiant de l'utilisateur en tant que paramètre (CRUD)
    header('Location: index.php'); // Rediriger vers la page d'accueil après la suppression de l'utilisateur de la base de données SQLite (CRUD)
    exit();
} else {
    // Rediriger vers la page d'accueil si l'identifiant de l'utilisateur n'est pas défini dans l'URL
    header('Location: index.php');
    exit();
}