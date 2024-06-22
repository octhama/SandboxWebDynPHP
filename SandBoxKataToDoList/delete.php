<?php
include 'script/functions.php';

if (isset($_GET['id'])) {
    deleteTodoToTrash($_GET['id']);
}

header('Location: index.php');
exit;
