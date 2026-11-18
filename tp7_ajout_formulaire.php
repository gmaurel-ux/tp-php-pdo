<!--
  TP 7 – FORMULAIRE D'AJOUT

  Quand le formulaire est envoyé :
  1. Ajouter le jeu dans la base avec une requête préparée
     (marqueurs nommés : :titre, :genre, :annee, :note).
  2. Afficher : Jeu ajouté ! Son id est : ...
  3. Afficher un lien vers la liste des jeux (tp3_liste.php).

  Test : ajouter le jeu Assassin's Creed. Est-ce que ça fonctionne ?
  Réponse : oui, car la requête préparée envoie le titre comme donnée
  (l'apostrophe n'est pas interprétée comme du SQL).
-->
<?php require 'connexion.php'; ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>TP 7 - Ajouter un jeu</title>
</head>

<body>
    <h1>Ajouter un jeu</h1>

    <form method="post">
        <p>Titre : <input type="text" name="titre" required></p>
        <p>Genre : <input type="text" name="genre" required></p>
        <p>Année : <input type="number" name="annee" required></p>
        <p>Note : <input type="number" name="note" min="0" max="20" required></p>
        <button type="submit">Ajouter</button>
    </form>

    <?php
    if (isset($_POST['titre'])) {
        $titre = $_POST['titre'];
        $genre = $_POST['genre'];
        $annee = $_POST['annee'];
        $note = $_POST['note'];

        $req = $base->prepare('INSERT INTO jeu (titre, genre, annee, note) VALUES (:titre, :genre, :annee, :note)');
        $req->execute([
            'titre' => $titre,
            'genre' => $genre,
            'annee' => $annee,
            'note' => $note
        ]);

        echo '<p>Jeu ajouté ! Son id est : ' . $base->lastInsertId() . '</p>';
        echo '<p><a href="tp3_liste.php">Voir la liste des jeux</a></p>';
    }
    ?>
</body>

</html>