<?php
// Fonction pour changer le fond d'écran (mode nuit ou jour)
function changeBackground (): void
{
    if (isset($_POST['submit'])) {
        $color = $_POST['color'];
        echo "<body style='background-color: $color;'>";
    } else {
        echo "<body style='background-color: white;'>";
    }
}
