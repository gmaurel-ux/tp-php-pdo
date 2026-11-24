<?php
/*
  TP 9 – BONUS : MINI-APPLICATION

  Réunir sur une seule page :
  1. Un titre avec le nombre de jeux : Ma ludothèque (10 jeux)
     (dans le <title> et dans le <h1>)
  2. Un tableau de tous les jeux, du mieux noté au moins bien noté.
  3. Un lien « Supprimer » sur chaque ligne :
     tp9_bonus_ludotheque.php?supprimer=ID
  4. Un formulaire d'ajout de jeu (comme au TP 7).

  Les titres et genres affichés doivent être protégés.
  Test : ajouter un jeu dont le titre est <b>Test</b>. Que voit-on ?
*/

require 'connexion.php';

if (isset($_GET['supprimer'])) {
    $id = (int) $_GET['supprimer'];
    $stmt = $base->prepare('DELETE FROM jeu WHERE id = :id');
    $stmt->execute([':id' => $id]);
    header('Location: tp9_bonus_ludotheque.php');
    exit;
}

if (isset($_POST['titre'], $_POST['genre'], $_POST['annee'], $_POST['note'])) {
    $stmt = $base->prepare('INSERT INTO jeu (titre, genre, annee, note) VALUES (:titre, :genre, :annee, :note)');
    $stmt->execute([
        ':titre' => $_POST['titre'],
        ':genre' => $_POST['genre'],
        ':annee' => (int) $_POST['annee'],
        ':note' => (int) $_POST['note']
    ]);
    header('Location: tp9_bonus_ludotheque.php');
    exit;
}

$countStmt = $base->query('SELECT COUNT(*) AS nb_jeux FROM jeu');
$nbJeux = (int) $countStmt->fetchColumn();

$res = $base->query('SELECT id AS jeu_id, titre AS jeu_titre, genre AS jeu_genre, annee AS jeu_annee, note AS jeu_note FROM jeu ORDER BY jeu_note DESC');
$jeux = $res->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Ma ludothèque (<?= $nbJeux ?> jeux)</title>
</head>
<body>
    <h1>Ma ludothèque (<?= $nbJeux ?> jeux)</h1>

    <table border="1">
        <tr><th>Titre</th><th>Genre</th><th>Année</th><th>Note</th><th></th></tr>
        <?php foreach ($jeux as $jeu): ?>
        <tr>
            <td><?= htmlspecialchars($jeu['jeu_titre'], ENT_QUOTES, 'UTF-8') ?></td>
            <td><?= htmlspecialchars($jeu['jeu_genre'], ENT_QUOTES, 'UTF-8') ?></td>
            <td><?= (int) $jeu['jeu_annee'] ?></td>
            <td><?= (int) $jeu['jeu_note'] ?>/20</td>
            <td><a href="tp9_bonus_ludotheque.php?supprimer=<?= (int) $jeu['jeu_id'] ?>" onclick="return confirm('Supprimer ce jeu ?');">Supprimer</a></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <h2>Ajouter un jeu</h2>
    <form method="post">
        <p>Titre : <input type="text" name="titre" required></p>
        <p>Genre : <input type="text" name="genre" required></p>
        <p>Année : <input type="number" name="annee" required></p>
        <p>Note : <input type="number" name="note" min="0" max="20" required></p>
        <button type="submit">Ajouter</button>
    </form>
</body>
</html>