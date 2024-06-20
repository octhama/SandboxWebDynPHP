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

    // Ajouter la nouvelle catégorie personnalisée si elle n'est pas vide et n'existe pas déjà dans les catégories prédéfinies
    if (!empty($_POST['newCustomCategory'])) {
        $newCategories[] = $_POST['newCustomCategory'];
    }

    $newCategoryString = implode(',', $newCategories); // Convertir le tableau en chaîne séparée par des virgules (si plusieurs catégories)
    //PS : implode() est un fonction PHP qui permet de convertir un tableau en chaîne de caractères en les séparant par un délimiteur
    // Exemple : implode(',', ['Travail', 'Personnel', 'Autre']) retourne 'Travail, Personnel, Autre')
    // On a aussi la fonction join() qui fait la même chose que implode() mais avec les arguments inversés : join(',', ['Travail', 'Personnel', 'Autre'])
    // explode() est l'inverse de implode() : il permet de convertir une chaîne de caractères en tableau en utilisant un délimiteur
    // Exemple : explode(',', 'Travail,Personnel,Autre') retourne ['Travail', 'Personnel', 'Autre'])
    

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
