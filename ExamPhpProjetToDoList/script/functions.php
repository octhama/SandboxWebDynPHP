<?php

function getTodos(): array
{
    if (!file_exists('todos.csv')) {
        return [];
    }

    $file = fopen('todos.csv', 'r');
    $todos = [];
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
            'completed' => $line[4] === '1',
            'priority' => $line[5],
            'progress' => $line[6],
            'category' => $line[7]
        ];
    }

    fclose($file);

    // Tri des tâches par ordre de priorité décroissante
    usort($todos, function ($a, $b) {
        if ($a['completed'] === $b['completed']) {
            return $b['priority'] <=> $a['priority'];
        }
        return $a['completed'] <=> $b['completed'];
    });

    return $todos;
}

// Sauvegarde des tâches dans le fichier CSV
function saveTodos($todos): void
{
    $file = fopen('todos.csv', 'w');

    foreach ($todos as $todo) {
        fputcsv($file, [
            $todo['id'],
            $todo['task'],
            $todo['date'],
            $todo['time'],
            $todo['completed'] ? '1' : '0',
            $todo['priority'],
            $todo['progress'],
            $todo['category']
        ]);
    }

    fclose($file);
}

// Génère un nouvel identifiant unique pour une nouvelle tâche
function getNewId() {
    $todos = getTodos();
    $ids = array_map(function ($todo) {
        return $todo['id'];
    }, $todos);

    return $ids ? max($ids) + 1 : 1;
}

// Retourne la liste des catégories disponibles
function getCategories(): array
{
    return [
        'Travail',
        'Personnel',
        'Courses',
        'Autre'
    ];
}

// Retourne la couleur Bootstrap associée à une catégorie
function getCategoryColor($category): string
{
    return match ($category) {
        'Travail' => 'primary',
        'Personnel' => 'secondary',
        'Courses' => 'success',
        'Autre' => 'danger',
        default => 'dark',
    };
}

// Retourne l'icône Font Awesome associée à une catégorie
function getCategoryIcon($category): string
{
    return match ($category) {
        'Travail' => 'fa-briefcase',
        'Personnel' => 'fa-user',
        'Courses' => 'fa-shopping-cart',
        'Autre' => 'fa-question',
        default => 'fa-star',
    };
}

// Retourne un badge Bootstrap pour une catégorie
function getCategoryBadge($category): string
{
    return '<span class="badge bg-' . getCategoryColor($category) . '"><i class="fas ' . getCategoryIcon($category) . '"></i> ' . $category . '</span> ';
}

// Retourne les options de sélection pour les catégories
function getCategoryOptions($selectedCategories): string
{
    $options = '';
    $selectedCategories = is_array($selectedCategories) ? $selectedCategories : [$selectedCategories];

    foreach (getCategories() as $category) {
        $selected = in_array($category, $selectedCategories) ? ' selected' : '';
        $options .= '<option value="' . $category . '"' . $selected . '>' . $category . '</option>';
    }

    return $options;
}

// Retourne un badge Bootstrap pour la priorité
function getPriorityBadge($priority): string
{
    $color = $priority > 5 ? 'danger' : ($priority > 3 ? 'warning' : 'success');
    return '<span class="badge bg-' . $color . '">' . $priority . '</span>';
}

// Retourne les options de sélection pour la priorité
function getPriorityOptions($selectedPriority): string
{
    $options = '';

    for ($i = 1; $i <= 10; $i++) {
        $selected = $i == $selectedPriority ? ' selected' : '';
        $options .= '<option value="' . $i . '"' . $selected . '>' . $i . '</option>';
    }

    return $options;
}

// Retourne les options de sélection pour le niveau de progression
function getProgressOptions($selectedValue = 0): string
{
    $options = '';
    $values = [0, 10, 20, 30, 40, 50, 60, 70, 80, 90, 100];

    foreach ($values as $value) {
        $selected = ($value == $selectedValue) ? 'selected' : '';
        $options .= "<option value=\"$value\" $selected>$value%</option>"; // .= permet de concaténer les options
    }

    return $options;
}
