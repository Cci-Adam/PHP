<?php

Utils::verifAdmin();
$errors = [];
$exists = false;
require_once('./models/User.php');
$userObj = new User();
$users = $userObj->getAll();




include "./views/base.phtml";
?>