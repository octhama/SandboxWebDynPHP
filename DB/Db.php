<?php
class Db
{
    private $conn;

    public function __construct($sqlite = 'esadb.db')
    {
        // Initialiser la connexion à la base de données SQLite
        $this->conn = new PDO('sqlite:' . $sqlite);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Activer les erreurs PDO
    }

    // Récupérer tous les utilisateurs
    public function findAll()
    {
        $sql = 'SELECT * FROM users ORDER BY id DESC';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ); // Renvoyer les résultats sous forme d'objets
    }

    // Enregistrer un utilisateur
    public function store($data)
    {
        $sql = 'INSERT INTO users (nom, prenom, email) VALUES (?, ?, ?)';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data); // Exécuter la requête avec les données
    }
}
