<?php 

$pdo = new PDO('sqlite:esa.db');
 $sql = "
 CREATE TABLE users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nom VARCHAR(50),
    prenom VARCHAR(20),
    email TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

 ";

 $pdo->exec($sql);
