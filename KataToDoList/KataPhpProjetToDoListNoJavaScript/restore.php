<?php
include 'script/functions.php';

if (isset($_GET['id'])) {
    restoreTodo($_GET['id']);
}

header('Location: trash.php');
exit;
