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
<?php require 'connexion.php'; ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>TP 8 - Modifier et supprimer</title>
</head>

<body>
    <?php
    if (isset($_POST['id_modif']) && isset($_POST['note'])) {
        $id = (int) $_POST['id_modif'];
        $note = (int) $_POST['note'];

        $stmt = $base->prepare('UPDATE jeu SET note = :note WHERE id = :id');
        $stmt->execute([':note' => $note, ':id' => $id]);

        if ($stmt->rowCount() > 0) {
            echo '<p>Note modifiée.</p>';
        } else {
            echo '<p>Aucun jeu modifié.</p>';
        }
    }

    // Supprimer
    if (isset($_POST['id_suppr'])) {
        $id = (int) $_POST['id_suppr'];

        $stmt = $base->prepare('DELETE FROM jeu WHERE id = :id');
        $stmt->execute([':id' => $id]);

        if ($stmt->rowCount() > 0) {
            echo '<p>Jeu supprimé.</p>';
        } else {
            echo '<p>Aucun jeu supprimé.</p>';
        }
    }
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

    <h2>Liste des jeux</h2>
    <?php
    $res = $base->query('SELECT * FROM jeu');
    while ($jeu = $res->fetch(PDO::FETCH_ASSOC)) {
        echo (int) $jeu['id'] . ' - ' . htmlspecialchars($jeu['titre'], ENT_QUOTES, 'UTF-8') . ' (' . (int) $jeu['note'] . '/20)<br>';
    }
    ?>
</body>

</html>