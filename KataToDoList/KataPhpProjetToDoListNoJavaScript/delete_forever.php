<?php
include 'script/functions.php';

if (isset($_GET['id'])) {
    deleteTodoPermanently($_GET['id']);
}

header('Location: trash.php');
exit;
