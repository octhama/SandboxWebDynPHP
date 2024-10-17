<?php
echo '<pre>';
var_dump($_POST);
echo '</pre>';

// Si un des trois champs est vide on retourne dans le ffoormulaire sinon on retourne à la page index.php
if (empty($_POST['name']) || empty($_POST['prenom']) || empty($_POST['email'])) {
    $db = new db(); // on instancie la classe db pour pouvoir utiliser la méthode store qui permet d'enregistrer les données dans la base de données
    $db->store($_POST); // on enregistre les données dans la base de données
    header('Location: create.php');
    exit();
}
exit();
