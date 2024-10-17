<?php
// Créer une classe Db qui permet de se connecter à la base de données et d'enregistrer les données dans la base de données avec un attribut connexion
class Db
{
    private $conn;
    public function __construct()
    {
        $this->conn = new PDO('sqlite:esadb.db'); // on se connecte à la base de données
    }
    public function store($data) // on crée une méthode store qui permet d'enregistrer les données dans la base de données
    {
        $sql = 'INSERT INTO users (nom, prenom, email) VALUES (:nom, :prenom, :email)'; // on crée une requête sql pour insérer les données dans la base de données
        $stmt = $this->conn->prepare($sql); // on prépare la requête sql
        $stmt->execute($data); // on exécute la requête sql
    }
}
