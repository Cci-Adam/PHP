<?php
Utils::verifAdmin();

require_once('./models/Monstre.php');
$monstreObj = new Monstre();
$monstres = $monstreObj->getAll();




include "./views/base.phtml";
?>