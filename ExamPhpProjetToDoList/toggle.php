<?php
include 'script/functions.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    $id = '';
}

if (!empty($id)) {
    toggleTodo($id);
}

header('Location: index.php');
exit;

