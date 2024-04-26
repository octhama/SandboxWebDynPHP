<?php
// Colorer chaque caractère de mots d'une phrase en entrée en couleur sauf les espaces
$echo = "Entrez une phrase : ";
$phrase = readline($echo);
$phrase = str_split($phrase);

foreach ($phrase as $lettre) {
    if ($lettre == " ") {
        echo $lettre;
    } else {
        // Différente couleur pour chaque caractère de mots d'une phrase en entrée en couleur sauf les espaces
        echo "\033[" . rand(31, 37) . "m" . $lettre . "\033[0m"; // Couleur aléatoire pour chaque lettre
    }
}
