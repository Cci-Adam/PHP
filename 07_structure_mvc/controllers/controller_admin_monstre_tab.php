<?php
verifAdmin();
$errors = [];
$exists = false;
$db = connectDB();
$query = $db->prepare("SELECT * FROM monstre ");
$query->execute();
$monstres = $query->fetchAll(PDO::FETCH_ASSOC);




include "./views/base.phtml";
?>