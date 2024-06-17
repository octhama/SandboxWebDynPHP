<?php
include 'script/functions.php';

$id = $_GET['id'];
$todos = getTodos();
// Suppression de la tâche avec l'ID spécifié dans l'URL
$todos = array_filter($todos, function($todo) use ($id) {
    return $todo['id'] != $id;
});

saveTodos($todos);

header('Location: index.php');
