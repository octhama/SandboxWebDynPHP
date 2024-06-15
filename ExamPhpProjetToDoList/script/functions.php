<?php
function getTodos(): array
{
    $todos = [];
    if (file_exists('todos.csv')) {
        $file = fopen('todos.csv', 'r');
        while (($row = fgetcsv($file)) !== false) {
            $id = $row[0];
            $task = $row[1];
            $date = $row[2] ?? '';
            $time = $row[3] ?? '';
            $completed = isset($row[4]) && $row[4];
            $todos[] = [
                'id' => $id,
                'task' => $task,
                'date' => $date,
                'time' => $time,
                'completed' => $completed,
            ];
        }
        fclose($file);
    }
    return $todos;
}

function saveTodos($todos): void
{
    $file = fopen('todos.csv', 'w');
    foreach ($todos as $todo) {
        fputcsv($file, [$todo['id'], $todo['task'], $todo['date'], $todo['time'], $todo['completed']]);
    }
    fclose($file);
}

function getNewId(): string
{
    return uniqid();
}

function addTodo($task, $date, $time): void
{
    $todos = getTodos();
    $newTodo = [
        'id' => getNewId(),
        'task' => $task,
        'date' => $date,
        'time' => $time,
        'completed' => false,
    ];
    $todos[] = $newTodo;
    saveTodos($todos);
}

function deleteTodo($id): void
{
    $todos = getTodos();
    $todos = array_filter($todos, function($todo) use ($id) {
        return $todo['id'] !== $id;
    });
    saveTodos($todos);
}

function toggleTodo($id): void
{
    $todos = getTodos();
    foreach ($todos as &$todo) {
        if ($todo['id'] === $id) {
            $todo['completed'] = !$todo['completed'];
            break;
        }
    }
    saveTodos($todos);
}

function editTodo($id, $task, $date, $time): void
{
    $todos = getTodos();
    foreach ($todos as &$todo) {
        if ($todo['id'] === $id) {
            $todo['task'] = $task;
            $todo['date'] = $date;
            $todo['time'] = $time;
            break;
        }
    }
    saveTodos($todos);
}
