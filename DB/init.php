<?php
$pdo = new PDO('sqlite:esadb.db');
$sql = 'CREATE TABLE users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nom VARCHAR(50),
    prenom VARCHAR(20),
    email VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP
)';
$pdo->exec($sql);
