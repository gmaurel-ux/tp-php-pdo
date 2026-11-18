<!--
  TP 8 – MODIFIER ET SUPPRIMER

  1. Formulaire « Modifier » : changer la note du jeu qui a cet id.
     Afficher « Note modifiée. » ou « Aucun jeu modifié. »
  2. Formulaire « Supprimer » : supprimer le jeu qui a cet id.
     Afficher « Jeu supprimé. » ou « Aucun jeu supprimé. »
  3. En bas de page, afficher la liste des jeux, à jour : 1 - Minecraft (18/20)

  Utiliser des requêtes préparées.
  Test : essayer de modifier le jeu avec l'id 999.
-->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>TP 8 - Modifier et supprimer</title>
</head>
<body>
<?php

?>

    <h2>Modifier une note</h2>
    <form method="post">
        Id : <input type="number" name="id_modif" required>
        Nouvelle note : <input type="number" name="note" min="0" max="20" required>
        <button type="submit">Modifier</button>
    </form>

    <h2>Supprimer un jeu</h2>
    <form method="post">
        Id : <input type="number" name="id_suppr" required>
        <button type="submit">Supprimer</button>
    </form>

    <a href="tp3_liste.php">voir la liste des jeux</a>
<?php

?>
</body>
</html>
