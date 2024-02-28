<?php
verifAdmin();
$errors = [];
$exists = false;
$db = connectDB();
$query = $db->prepare("SELECT * FROM user left join user_details on user.id = user_id");
$query->execute();
$users = $query->fetchAll(PDO::FETCH_ASSOC);




include "./views/base.phtml";
?>