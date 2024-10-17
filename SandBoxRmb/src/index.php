<!DOCTYPE html>
<html>
<head>
    <title>Sandbox</title>
</head>
<body>
    <h1>Test Sandbox</h1>
    <p>Test Clique </p>
    <?php
        if (isset($_GET['message'])) {
            echo '<p>' . $_GET['message'] . '</p>';
        }
    ?>
    <a href="index.php?message=Hello">Clique ici</a>
    <br>    <br>    <br>    <br>    <br>    <br>
    <?php
        $phrase = "L'eusses-tu cru que ton père fût là peint ?";
        echo "<strong>$phrase</strong>";
        echo "<br>";
        echo "Nombre de caractères : " . strlen($phrase);
    ?>
    <br>    <br>    <br>    <br>    <br>    <br>
    <?php
        // Formulaires nom et prénom (au clique sur le bouton affiche nom et prénom sans aucune consonne prenant en compte les majuscules)
        if (isset($_POST['phrase'])) {
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $phrase = $nom . " " . $prenom;
            $consonnes = ['p', 'b', 't', 'd', 'k', 'g', 'f', 'v', 's', 'z', 'ʃ', 'ʒ', 'j', 'm', 'n', 'ɲ', 'l', 'r', 'j', 'w', 'ɥ'];
            $consonnes_majuscules = array_map('strtoupper', $consonnes);
            $phrase = str_replace($consonnes, '', $phrase);
            $phrase = str_replace($consonnes_majuscules, '', $phrase);
            echo "<p>$phrase</p>";

        }
    ?>
    <form method="post">
        <input type="text" name="nom" placeholder="Nom">
        <input type="text" name="prenom" placeholder="Prénom">
        <button type="submit" name="phrase">Envoyer</button>
    </form>

    <br>    <br>    <br>    <br>    <br>    <br>
    <?php
        // Dans une page affiche texte de Jean de La Fontaine...dans une page précédente, tu mets un input dans lequel on met le mot qu'on doit rechercher dans le texte et tu détermines si le mot est présent ou non et son occurrence
    // et lorsqu'on clique sur le bouton rechercher affiche aussi le texte de Jean de La Fontaine avant le mot recherché surligné au marqueur jaune

        $texte = "Maître Corbeau, sur un arbre perché, Tenait en son bec un fromage. 
        Maître Renard, par l'odeur alléché, Lui tint à peu près ce langage : 
        Et bonjour, Monsieur du Corbeau, Que vous êtes joli ! que vous me semblez beau ! Sans
        mentir, si votre ramage Se rapporte à votre plumage, Vous êtes le Phénix des hôtes de ces bois. 
        À ces mots le Corbeau ne se sent pas de joie ; Et pour montrer sa belle voix, Il ouvre un large bec, laisse tomber sa proie. 
        Le Renard s'en saisit, et dit : Mon bon Monsieur, Apprenez que tout flatteur Vit aux dépens de celui qui l'écoute : 
        Cette leçon vaut bien un fromage, sans doute. 
        Le Corbeau, honteux et confus, Jura, mais un peu tard, qu'on ne l'y prendrait plus.";

        if (isset($_POST['mot'])) {
            $mot = $_POST['mot'];
            $occurrence = substr_count($texte, $mot);
            if ($occurrence > 0) {
                echo "<p>Le mot $mot est présent $occurrence fois dans le texte</p>";
                $texte = str_replace($mot, "<mark>$mot</mark>", $texte);
                echo "<p>$texte</p>";
            } else {
                echo "<p>Le mot $mot n'est pas présent dans le texte</p>";
            }
        }
    ?>
    <form method="post">
        <input type="text" name="mot" placeholder="Mot à rechercher">
        <button type="submit">Rechercher</button>
    </form>
</body>
</html>
