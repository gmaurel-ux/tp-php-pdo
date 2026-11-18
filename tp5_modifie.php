<?php
require 'connexion.php';

$nb = $base->exec("UPDATE jeu SET note = 15 WHERE titre = 'Fortnite'");
echo $nb . ' jeu(x) modifié(s).';