<?php

function getTodos(): array
{
    if (!file_exists('todos.csv')) {
        return [];
    }

    $file = fopen('todos.csv', 'r');
    $todos = []; // Initialise un tableau vide pour stocker les tâches lues à partir du fichier CSV (todos.csv) PS : [] est une syntaxe équivalente à array()
    $expectedColumnCount = 8; // Nombre de colonnes attendu dans chaque ligne

    while (($line = fgetcsv($file)) !== false) {
        if (count($line) < $expectedColumnCount) {
            continue; // Ignore les lignes avec un nombre de colonnes incorrect
        }
        $todos[] = [
            'id' => $line[0],
            'task' => $line[1],
            'date' => $line[2],
            'time' => $line[3],
            'completed' => $line[4] === '1', // Convertit la chaîne '1' en booléen true, sinon false (statut de complétion) PS : === pour comparer le type et la valeur
            'priority' => $line[5],
            'progress' => $line[6],
            'category' => $line[7]
        ];
    }

    fclose($file);

    // Tri des tâches par ordre de priorité décroissante et de statut de complétion croissant (non complété en premier)
    usort($todos, function ($a, $b) { // usort() trie un tableau en utilisant une fonction de comparaison utilisateur et conserve les clés d'origine
        if ($a['completed'] === $b['completed']) { // Si les tâches ont le même statut de complétion
            return $b['priority'] <=> $a['priority']; // Trie par priorité décroissante
        }
        return $a['completed'] <=> $b['completed']; // Trie par statut de complétion croissant
    });

    return $todos; // Retourne le tableau des tâches triées par priorité et statut de complétion
}

// Sauvegarde des tâches dans le fichier CSV (écrase le contenu existant)
function saveTodos(array $todos, string $filename = 'todos.csv'): void
{
    $file = fopen($filename, 'w'); // Ouvre le fichier en mode écriture (crée un nouveau fichier s'il n'existe pas)

    foreach ($todos as $todo) {
        fputcsv($file, [
            $todo['id'],
            $todo['task'],
            $todo['date'],
            $todo['time'],
            $todo['completed'] ? '1' : '0', // Convertit le booléen en '1' ou '0' pour le statut de complétion dans le fichier CSV
            $todo['priority'],
            $todo['progress'],
            $todo['category']
        ]);
    }

    fclose($file); // Ferme le fichier après avoir écrit toutes les tâches
}

// Génère un nouvel identifiant unique pour une nouvelle tâche en fonction des tâches existantes (le plus élevé + 1)
function getNewId(): int
{
    $todos = getTodos(); // Récupère les tâches existantes pour trouver le plus grand ID existant et l'incrémenter de 1 si nécessaire
    $ids = array_map(function ($todo) { // array_map() applique une fonction à chaque élément d'un tableau et retourne un tableau avec les résultats
        return $todo['id']; // Retourne un tableau contenant uniquement les ID des tâches existantes pour la comparaison et la recherche du plus élevé + 1
    }, $todos); // $todos est le tableau de tâches existantes avec des ID

    return $ids ? max($ids) + 1 : 1; // Incrémente l'ID le plus élevé ou retourne 1 si le tableau est vide (première tâche)
}

// Retourne la liste des catégories disponibles pour les tâches (travail, personnel, courses, autre)
function getCategories(): array
{
    return [
        'Travail',
        'Personnel',
        'Courses',
        'Autre'
    ];
}

// Retourne la couleur Bootstrap associée à une catégorie de tâche donnée (par défaut, gris foncé)
function getCategoryColor(string $category): string
{
    return match ($category) {
        'Travail' => 'primary',
        'Personnel' => 'secondary',
        'Courses' => 'success',
        'Autre' => 'danger',
        default => 'dark'
    };
}

// Retourne l'icône Font Awesome associée à une catégorie de tâche donnée (par défaut, une étoile)
function getCategoryIcon(string $category): string
{
    return match ($category) {
        'Travail' => 'fa-briefcase',
        'Personnel' => 'fa-user',
        'Courses' => 'fa-shopping-cart',
        'Autre' => 'fa-question',
        default => 'fa-star'
    };
}

// Retourne un badge Bootstrap pour une catégorie de tâche donnée (avec icône Font Awesome)
function getCategoryBadge(string $category): string
{
    return '<span class="badge bg-' . getCategoryColor($category) . '"><i class="fas ' . getCategoryIcon($category) . '"></i> ' . $category . '</span> ';
}

// Retourne les options de sélection pour les catégories avec les catégories sélectionnées par défaut (tableau ou chaîne)
function getCategoryOptions($selectedCategories): string
{
    $options = '';
    $selectedCategories = is_array($selectedCategories) ? $selectedCategories : [$selectedCategories]; // Convertit en tableau si ce n'est pas déjà le cas (pour la cohérence)

    foreach (getCategories() as $category) {
        $selected = in_array($category, $selectedCategories) ? ' selected' : ''; // Vérifie si la catégorie est sélectionnée par défaut (dans le tableau)
        $options .= '<option value="' . $category . '"' . $selected . '>' . $category . '</option>';
    }

    return $options;
}

// Retourne un badge Bootstrap pour la priorité d'une tâche en fonction de sa valeur (1 à 10)
function getPriorityBadge(int $priority): string
{
    $color = $priority > 5 ? 'danger' : ($priority > 3 ? 'warning' : 'success'); // Détermine la couleur en fonction de la priorité (rouge pour > 5, orange pour > 3, vert pour le reste)
    return '<span class="badge bg-' . $color . '">' . $priority . '</span>';
}

// Retourne les options de sélection pour la priorité de la tâche avec la priorité sélectionnée par défaut (1 à 10)
function getPriorityOptions(int $selectedPriority): string
{
    $options = '';

    for ($i = 1; $i <= 10; $i++) {
        $selected = $i == $selectedPriority ? ' selected' : '';
        $options .= '<option value="' . $i . '"' . $selected . '>' . $i . '</option>';
    }

    return $options;
}

// Retourne les options de sélection pour le niveau de progression
function getProgressOptions(int $selectedValue = 0): string
{
    $options = '';
    $values = [0, 10, 20, 30, 40, 50, 60, 70, 80, 90, 100];

    foreach ($values as $value) {
        $selected = ($value == $selectedValue) ? 'selected' : '';
        $options .= "<option value=\"$value\" $selected>$value%</option>"; // .= permet de concaténer les options pour chaque valeur de progression
    }

    return $options;
}

// Retourne les tâches supprimées de la corbeille (trash.csv) pour les afficher dans la vue de la corbeille
function getDeletedTodos(): array
{
    if (!file_exists('trash.csv')) {
        return [];
    }

    $file = fopen('trash.csv', 'r');
    $deletedTodos = [];
    $expectedColumnCount = 8; // Nombre de colonnes attendu dans chaque ligne

    while (($line = fgetcsv($file)) !== false) {
        if (count($line) < $expectedColumnCount) {
            continue; // Ignore les lignes avec un nombre de colonnes incorrect
        }
        $deletedTodos[] = [
            'id' => $line[0],
            'task' => $line[1],
            'date' => $line[2],
            'time' => $line[3],
            'completed' => $line[4] === '1',
            'priority' => $line[5],
            'progress' => $line[6],
            'category' => $line[7]
        ];
    }

    fclose($file);

    return $deletedTodos;
}

// Supprime une tâche de la liste des tâches et la déplace dans la corbeille (trash.csv) pour la récupérer plus tard
function deleteTodoToTrash($id): void
{
    $todos = getTodos();
    $deletedTodos = getDeletedTodos();
    foreach ($todos as $index => $todo) {
        if ($todo['id'] == $id) {
            $deletedTodos[] = $todo;
            unset($todos[$index]); // Supprime la tâche de la liste des tâches (todos.csv)
            saveTodos($todos); // Enregistre les tâches restantes dans la liste des tâches (todos.csv) après la suppression de la tâche déplacée
            saveTodos($deletedTodos, 'trash.csv');
            return;
        }
    }
}

// Supprime définitivement une tâche de la corbeille (trash.csv)
function deleteTodoPermanently($id): void
{
    $deletedTodos = getDeletedTodos();
    foreach ($deletedTodos as $index => $todo) {
        if ($todo['id'] == $id) {
            unset($deletedTodos[$index]); // Supprime la tâche de la corbeille (trash.csv) de manière permanente
            saveTodos($deletedTodos, 'trash.csv'); // Enregistre les tâches restantes dans la corbeille
            return;
        }
    }
}

// Restaure une tâche supprimée de la corbeille (la déplace de trash.csv à todos.csv)
function restoreTodo($id): void
{
    $todos = getTodos();
    $deletedTodos = getDeletedTodos();
    foreach ($deletedTodos as $index => $todo) {
        if ($todo['id'] == $id) {
            $todos[] = $todo;
            unset($deletedTodos[$index]); // Supprime la tâche restaurée de la corbeille (trash.csv)
            saveTodos($todos); // Enregistre la tâche restaurée dans la liste des tâches (todos.csv) pour la restaurer complètement
            saveTodos($deletedTodos, 'trash.csv'); // Enregistre les tâches restantes dans la corbeille
            return;
        }
    }
}
