<?php
echo '<pre>';
var_dump($_POST);
echo '</pre>';

// si un des trois champs est vide on retourne dans le ffoormulaire sinon on retourne à la page index.php
if (empty($_POST['name']) || empty($_POST['prenom']) || empty($_POST['email'])) {
    header('Location: create.php');
    exit();
}
exit();
