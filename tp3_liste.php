<!--
  TP 3 – LISTER LES JEUX DANS UN TABLEAU HTML

  Afficher tous les jeux dans le tableau ci-dessous, une ligne par jeu.
  La note s'affiche sur 20 : 18/20
-->
<?php require 'connexion.php'; ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>TP 3 - Liste des jeux</title>
</head>

<body>
    <h1>Liste des jeux</h1>

    <table border="1">
        <tr>
            <th>Titre</th>
            <th>Genre</th>
            <th>Année</th>
            <th>Note</th>
        </tr>
        <?php
        $res = $base->query('SELECT * FROM jeu');
        while ($jeu = $res->fetch(PDO::FETCH_ASSOC)) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($jeu['titre'], ENT_QUOTES, 'UTF-8') . '</td>';
            echo '<td>' . htmlspecialchars($jeu['genre'], ENT_QUOTES, 'UTF-8') . '</td>';
            echo '<td>' . (int) $jeu['annee'] . '</td>';
            echo '<td>' . (int) $jeu['note'] . '/20</td>';
            echo '</tr>';
        }
        ?>
    </table>
</body>

</html>