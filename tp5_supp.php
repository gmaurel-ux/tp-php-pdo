<?php
require 'connexion.php';

$nb = $base->exec("DELETE FROM jeu WHERE titre = 'Pac-Man'");
echo $nb . ' jeu(x) supprimé(s).';