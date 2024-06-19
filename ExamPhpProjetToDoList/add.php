<?php
include 'script/functions.php';
// Vérifier si le formulaire a été soumis pour ajouter une nouvelle tâche
if (isset($_POST['newTask'])) {
    $newTask = $_POST['newTask'];
    $newDate = $_POST['newDate'] ?? '';
    $newTime = $_POST['newTime'] ?? '';
    $newPriority = $_POST['newPriority'] ?? 0;
    $newProgress = intval($_POST['newProgress'] ?? 0); // intval() pour s'assurer que la valeur est un entier (0 par défaut)
    $newCategories = $_POST['newCategory'] ?? [];

    if (!empty($_POST['newCustomCategory'])) {
        $newCategories[] = $_POST['newCustomCategory'];
    }

    $newCategoryString = implode(',', $newCategories); // Convertir le tableau en chaîne séparée par des virgules (si plusieurs catégories)

    $todos = getTodos();
    // Création d'un nouveau tableau associatif pour la nouvelle tâche à ajouter
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
