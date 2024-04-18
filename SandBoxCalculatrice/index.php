<?php
echo "1. Je veux faire une somme" . "\n";
echo "2. Je veux faire une différence" . "\n";
echo "3.Je veux faire une multiplication" .  "\n";
echo "4.Je veux faire une division" . "\n";
echo "5. Je veux faire un modulo" . "\n";

echo "Choisissez une opération : ";
$choix = readline();
echo "Vous avez choisi l'opération : " . $choix . "\n";

if ($choix == 1) {
    $nombre1 = "Entrer le nombre 1";
    $nombre2 = "Entrer le nombre 2";
    echo "Nombre 1 : ";
    $nombre1 = readline();
    echo "Nombre 2 : ";
    $nombre2 = readline();
    echo $resultatsom = var_dump($nombre1 + $nombre2);
} elseif ($choix == 2) {
    $nombre1 = "Entrer le nombre 1";
    $nombre2 = "Entrer le nombre 2";
    echo "Nombre 1 : ";
    $nombre1 = readline();
    echo "Nombre 2 : ";
    $nombre2 = readline();
    echo $resultatdif = var_dump($nombre1 - $nombre2);
} elseif ($choix == 3) {
    $nombre1 = "Entrer le nombre 1";
    $nombre2 = "Entrer le nombre 2";
    echo "Nombre 1 : ";
    $nombre1 = readline();
    echo "Nombre 2 : ";
    $nombre2 = readline();
    echo $resultatmul = var_dump($nombre1 * $nombre2);
} elseif ($choix == 4) {
    $nombre1 = "Entrer le nombre 1";
    $nombre2 = "Entrer le nombre 2";
    echo "Nombre 1 : ";
    $nombre1 = readline();
    echo "Nombre 2 : ";
    $nombre2 = readline();
    echo $resultatdiv = var_dump($nombre1 / $nombre2);
} elseif ($choix == 5) {
    $nombre1 = "Entrer le nombre 1";
    $nombre2 = "Entrer le nombre 2";
    echo "Nombre 1 : ";
    $nombre1 = readline();
    echo "Nombre 2 : ";
    $nombre2 = readline();
    echo $resultatmod = var_dump($nombre1 % $nombre2);
} else {
    echo "Vous n'avez pas choisi une opération valide";
}
echo "\n";











