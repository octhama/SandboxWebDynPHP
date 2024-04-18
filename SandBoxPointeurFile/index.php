<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Liste des fichiers dans le document root</title>
</head>
<body>

<h1>Liste des fichiers dans le document root</h1>

<?php

// Obtenir le chemin du document root
$documentRoot = $_SERVER['DOCUMENT_ROOT'];

// Ouvrir le dossier document root
$pointeur = opendir($documentRoot); // Retourne un pointeur de dossier

// Vérifier si l'ouverture du dossier a réussi
if ($pointeur) {
    // Lire les fichiers et dossiers du document root
    while (($nomFichier = readdir($pointeur)) !== false) { // Lire le nom du fichier ou du dossier
        // Afficher le nom du fichier ou du dossier
        echo $nomFichier . "<br>"; // Affiche le nom du fichier ou du dossier
    }

    // Fermer le pointeur
    closedir($pointeur);
} else {
    // Erreur d'ouverture du dossier
    echo "Erreur d'ouverture du document root"; // Affiche un message d'erreur
}

?>


</body>
</html>
