<?php
include 'script/functions.php';

$id = $_GET['id'];
$todos = getTodos();

foreach ($todos as &$todo) {
    if ($todo['id'] == $id) {
        $todo['completed'] = !$todo['completed']; // Inverse la valeur de la clé 'completed' (true devient false et vice versa) pour basculer l'état de compléter ou non
        break;
    }
}

saveTodos($todos);

header('Location: index.php');
