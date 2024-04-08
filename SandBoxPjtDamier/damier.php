<?php
echo "<table>"; // tableau
for ($i = 0; $i < 8; $i++) { // ligne
    echo "<tr>";
    for ($j = 0; $j < 8; $j++) { // colonne
        // damier noir et blanc
        if (($i + $j) % 2 == 0) { // si la somme de i et j est paire alors case noire sinon case blanche
            echo "<td id='black'></td>"; // case noire
        } else {
            echo "<td id='white'></td>"; // case blanche
        }
    }
    echo "</tr>";
}






