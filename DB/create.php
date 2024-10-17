<!DOCTYPE html>
<html lang='fr'>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico">
    <title>DB - Create</title>
</head>
<body>
    <main class="container">
        <h1>ESA - CRUD</h1>
        <form action="store.php" method="post">
            <label for="name">Nom</label>
            <input type="text" name="name" id="name" required>
            <label for="prenom">Prénom</label>
            <input type="text" name="prenom" id="prenom" required>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>
            <button type="submit">Ajouter</button>
        </form>
    </main>
</html>