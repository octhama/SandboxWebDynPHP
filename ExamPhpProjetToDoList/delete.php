<?php
include 'script/functions.php';

$id = $_GET['id'];
$todos = getTodos();

$todos = array_filter($todos, function($todo) use ($id) {
    return $todo['id'] != $id;
});

saveTodos($todos);

header('Location: index.php');
