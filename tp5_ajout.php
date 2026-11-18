<?php
require 'connexion.php';

$base->exec("INSERT INTO jeu (titre, genre, annee, note) VALUES ('Pac-Man', 'Action', 1980, 16)");
echo "Pac-Man ajouté avec l'id " . $base->lastInsertId();