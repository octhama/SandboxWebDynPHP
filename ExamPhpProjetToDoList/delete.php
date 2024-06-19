<?php
include 'script/functions.php';

$id = $_GET['id'];
$todos = getTodos();
// Suppression de la tâche avec l'ID spécifié dans l'URL en utilisant array_filter()
$todos = array_filter($todos, function($todo) use ($id) {
    return $todo['id'] != $id; // Retourne toutes les tâches sauf celle avec l'ID spécifié (true pour garder, false pour supprimer)
});

saveTodos($todos);

header('Location: index.php');
