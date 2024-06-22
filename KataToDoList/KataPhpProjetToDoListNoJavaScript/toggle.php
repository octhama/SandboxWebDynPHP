<?php
// Inclure les fonctions nécessaires
include 'script/functions.php';

// Vérifier si l'ID est présent dans la requête GET
if (!isset($_GET['todo_id'])) {
    // Redirection si l'ID n'est pas fourni
    header('Location: index.php');
    exit;
}

// Récupérer l'ID du todo à basculer
$id = $_GET['todo_id'];
$todos = getTodos();

// Parcourir tous les todos pour trouver celui avec l'ID correspondant
foreach ($todos as &$todo) {
    if ($todo['id'] == $id) {
        // Inverser l'état de complétion
        $todo['completed'] = !$todo['completed'];
        break;
    }
}

// Sauvegarder les todos mis à jour
saveTodos($todos);

// Rediriger vers la page d'index
header('Location: index.php');
exit;
