<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Liste des fichiers dans le document root</title>
</head>
<body>

<h1>Liste des fichiers dans le document root</h1>

<?php
// Récupérer le chemin du document root
$documentRoot = $_SERVER['DOCUMENT_ROOT'];

// Ouvrir le répertoire du document root
$pointeur = opendir($documentRoot);

// Vérifier si le répertoire a été ouvert avec succès
if ($pointeur === false) {
    echo "Impossible d'ouvrir le répertoire du document root.";
} else {
    // Parcourir le répertoire
    while (($nomFichier = readdir($pointeur)) !== false) {
        // Ignorer les entrées spéciales "." et ".."
        if ($nomFichier != "." && $nomFichier != "..") {
            // Afficher le nom du fichier
            echo $nomFichier . "<br>";
        }
    }
    // Fermer le pointeur
    closedir($pointeur);
}
?>

</body>
</html>
