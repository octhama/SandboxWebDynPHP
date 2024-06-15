<?php
include 'script/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $task = $_POST['newTask'];
    $date = $_POST['newDate'];
    $time = $_POST['newTime'];
    addTodo($task, $date, $time);
}

header('Location: index.php');
exit;
