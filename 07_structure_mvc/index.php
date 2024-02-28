<?php
    session_start();
    require "./config.php";
    require "./services/router.php";
    require "./controllers/controller_{$page}.php";
?>

