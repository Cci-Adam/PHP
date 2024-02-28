<?php
$db = connectDB();
if ($db) {
    $sql = $db->prepare('SELECT * FROM monstre LIMIT 3');
    $sql->execute();
    $monstres= $sql->fetchAll(PDO::FETCH_ASSOC);
}
$x  = 1;
include "./views/base.phtml";
?>