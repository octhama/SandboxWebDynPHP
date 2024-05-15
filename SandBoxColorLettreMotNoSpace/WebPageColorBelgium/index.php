<?php

//VIVE LA BELGIQUE <3 !!

// Vérifier si le formulaire a été soumis et si la clé 'phrase' existe dans $_POST
if (isset($_POST['phrase'])) {
    // Récupérer la phrase saisie dans le formulaire
    $phrase = $_POST['phrase'];

    // Séparer la phrase en un tableau de lettres
    $lettres = str_split($phrase);

    // Tableau associatif des couleurs du drapeau belge
    $couleurs = [
        'black' => "#000000", // Noir
        'yellow' => "#FFFF00", // Jaune
        'red' => "#FF0000" // Rouge
    ];

    // Index pour parcourir le tableau des couleurs
    $couleur_index = 0;

    // Parcourir chaque lettre de la phrase
    foreach ($lettres as $lettre) {
        // Vérifier si la lettre est un espace
        if ($lettre == " ") {
            // Afficher l'espace sans couleur
            echo $lettre;
        } else {
            // Afficher la lettre avec la couleur correspondante du drapeau belge
            echo '<span style="color: ' . $couleurs[array_keys($couleurs)[$couleur_index]] . '">' . $lettre . '</span>';

            // Passer à la couleur suivante pour la prochaine lettre
            $couleur_index = ($couleur_index + 1) % count($couleurs);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Colorer les lettres d'une phrase aux couleurs du Drapeau Belge</title>
</head>
<body>
<form action="index.php" method="post">
    <label for="phrase">Entrez une phrase : </label>
    <input type="text" name="phrase" id="phrase" required>
    <button type="submit">Envoyer</button>
</form>
</body>
</html>
