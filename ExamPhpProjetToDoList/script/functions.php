<?php

function getTodos(): array
{
    if (!file_exists('todos.csv')) {
        return [];
    }

    $file = fopen('todos.csv', 'r');
    $todos = [];

    while (($line = fgetcsv($file)) !== false) {
        $todos[] = [
            'id' => $line[0],
            'task' => $line[1],
            'date' => $line[2],
            'time' => $line[3],
            'completed' => $line[4] === '1',
            'priority' => $line[5],
            'category' => $line[6]
        ];
    }

    fclose($file);

    // Tri des tâches par ordre de priorité décroissante
    usort($todos, function ($a, $b) { // usort trie un tableau en utilisant une fonction de comparaison
        if ($a['completed'] === $b['completed']) {
            return $b['priority'] <=> $a['priority'];
        }
        return $a['completed'] <=> $b['completed'];
    });

    return $todos;
}

function saveTodos($todos): void
{
    $file = fopen('todos.csv', 'w');

    foreach ($todos as $todo) {
        fputcsv($file, [
            $todo['id'],
            $todo['task'],
            $todo['date'],
            $todo['time'],
            $todo['completed'] ? '1' : '0', // il s'agit d'un if ternaire
            $todo['priority'],
            $todo['category']
        ]);
    }

    fclose($file);
}

function getNewId() {
    $todos = getTodos();
    $ids = array_map(function ($todo) {
        return $todo['id'];
    }, $todos);

    return $ids ? max($ids) + 1 : 1;
}

function addTodoToCSV($task, $date, $time, $priority, $category): void
{
    $file = fopen('todos.csv', 'a');
    $id = uniqid();
    fputcsv($file, [$id, $task, $date, $time, $priority, $category, 0]);
    fclose($file);
}

function getCategories(): array
{
    return [
        'Travail',
        'Personnel',
        'Courses',
        'Autre'
    ];
}

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

function getCategoryBadge($category): string
{
    return '<span class="badge bg-' . getCategoryColor($category) . '"><i class="fas ' . getCategoryIcon($category) . '"></i> ' . $category . '</span>';
}

function getCategoryOptions($selectedCategory): string
{
    $options = '';

    foreach (getCategories() as $category) {
        $selected = $category === $selectedCategory ? ' selected' : '';
        $options .= '<option value="' . $category . '"' . $selected . '>' . $category . '</option>';
    }

    return $options;
}

function getPriorityBadge($priority): string
{
    $color = $priority > 5 ? 'danger' : ($priority > 3 ? 'warning' : 'success');
    return '<span class="badge bg-' . $color . '">' . $priority . '</span>';
}

function getPriorityOptions($selectedPriority): string
{
    $options = '';

    for ($i = 1; $i <= 10; $i++) {
        $selected = $i == $selectedPriority ? ' selected' : '';
        $options .= '<option value="' . $i . '"' . $selected . '>' . $i . '</option>';
    }

    return $options;
}

function getProgress(): array
{
    return [
        '0%' => 0,
        '25%' => 25,
        '50%' => 50,
        '75%' => 75,
        '100%' => 100
    ];
}

