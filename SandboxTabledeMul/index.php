<?php
// Table de multiplication de 1 à 10

function displayTable (): void
{
    // Afficher les entêtes de colonnes
    echo "<table border='1'>";
    echo "<tr>";
    echo "<th> </th>";
    for ($i = 1; $i <= 10; $i++) {
        echo "<th>$i</th>";
    }
    echo "</tr>";

    // Afficher les lignes de la table de multiplication
    for ($i = 1; $i <= 10; $i++) {
        echo "<tr>";
        echo "<th>$i</th>";
        for ($j = 1; $j <= 10; $j++) {
            echo "<td>" . $i * $j . "</td>";
        }
        echo "</tr>";
    }

    echo "</table>";
}
