<?php
// Créer une classe Db qui permet de se connecter à la base de données et d'enregistrer les données dans la base de données avec un attribut connexion
class Db
{
    private $conn; // on crée un attribut connexion qui permet de se connecter à la base de données
    public function __construct($sqlite = 'esadb.db') // on crée un constructeur qui permet de se connecter à la base de données
    {
        $this->conn = new PDO('sqlite:' . $sqlite); // on se connecte à la base de données sqlite avec le nom de la base de données passée en paramètre
    }
    public function store($data) // on crée une méthode store qui permet d'enregistrer les données dans la base de données
    {
        $sql = 'INSERT INTO users (nom, prenom, email) VALUES (?, ?, ?)'; // on crée une requête sql qui permet d'insérer les données dans la base de données avec des paramètres nommés pour éviter les injections sql
        $stmt = $this->conn->prepare($sql); // on prépare la requête sql
        $stmt->execute($data); // on exécute la requête sql
    }
}
