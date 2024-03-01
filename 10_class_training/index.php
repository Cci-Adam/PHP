<?php
require_once('Voiture.php');
$titine = new Voiture('Ford', 'Mustang', 'Essence', 'Rouge');
echo $titine->marque;