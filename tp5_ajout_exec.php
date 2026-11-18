<?php
/*
  TP 5 – AJOUTER, MODIFIER, SUPPRIMER AVEC exec()

  1. Ajouter le jeu Pac-Man (genre Action, année 1980, note 16)
     puis afficher : Pac-Man ajouté avec l'id ...
  2. Passer la note de Fortnite à 15
     puis afficher le nombre de jeux modifiés.
  3. Supprimer Pac-Man
     puis afficher le nombre de jeux supprimés.

  Vérifier le résultat avec la page du TP 3.

  Question : que se passerait-il avec DELETE FROM jeu sans WHERE ?
  Réponse : toutes les lignes de la table jeu seraient supprimées.
*/

require 'connexion.php';

// 1. Ajout (voir aussi tp5_ajout.php)
$base->exec("INSERT INTO jeu (titre, genre, annee, note) VALUES ('Pac-Man', 'Action', 1980, 16)");
echo "Pac-Man ajouté avec l'id " . $base->lastInsertId() . "<br>";

// 2. Modification (voir aussi tp5_modifie.php)
$nb = $base->exec("UPDATE jeu SET note = 15 WHERE titre = 'Fortnite'");
echo $nb . ' jeu(x) modifié(s).<br>';

// 3. Suppression (voir aussi tp5_supp.php)
$nb = $base->exec("DELETE FROM jeu WHERE titre = 'Pac-Man'");
echo $nb . ' jeu(x) supprimé(s).';
