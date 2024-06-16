<?php
include 'script/functions.php';

$id = $_GET['id'];
$todos = getTodos();

foreach ($todos as &$todo) {
    if ($todo['id'] == $id) {
        $todo['completed'] = !$todo['completed'];
        break;
    }
}

saveTodos($todos);

header('Location: index.php');
