<?php
$getPage = isset($_GET['page']) ? strtolower($_GET['page']) : '';
$path = "./controllers/controller_" . $getPage . ".php";
$page = file_exists($path) ? $getPage : "home";
?>