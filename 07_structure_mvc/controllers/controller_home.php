<?php
require_once('./models/Monstre.php');
$monstreObj = new Monstre();
$monstres = $monstreObj->getAll(5);
$x  = 1; //Utile
include "./views/base.phtml";
?>