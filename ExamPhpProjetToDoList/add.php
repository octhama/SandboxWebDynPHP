<?php
include 'script/functions.php';

if (isset($_POST['newTask'])) {
    $newTask = $_POST['newTask'];
    $newDate = $_POST['newDate'] ?? '';
    $newTime = $_POST['newTime'] ?? '';
    $newPriority = $_POST['newPriority'] ?? 0;
    $newProgress = intval($_POST['newProgress'] ?? 0); // intval() pour s'assurer que la valeur est un entier
    $newCategories = $_POST['newCategory'] ?? [];

    if (!empty($_POST['newCustomCategory'])) {
        $newCategories[] = $_POST['newCustomCategory'];
    }

    $newCategoryString = implode(',', $newCategories);

    $todos = getTodos();
    $newTodo = [
        'id' => getNewId(),
        'task' => $newTask,
        'date' => $newDate,
        'time' => $newTime,
        'completed' => false,
        'priority' => $newPriority,
        'progress' => $newProgress,
        'category' => $newCategoryString
    ];

    $todos[] = $newTodo;
    saveTodos($todos);

    header('Location: index.php');
    exit;
} else {
    header('Location: index.php');
    exit;
}