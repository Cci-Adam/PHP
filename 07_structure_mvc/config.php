<?php
const CONFIG_SITE_TITLE = "MH_Website";
define("CONFIG_SITE_SLOGAN", "Site sur Monster Hunter");
const DB_HOST = "localhost";
const DB_NAME = "mvc_php";
const DB_USER = "root";
const DB_PASSWORD = "";
function connectDB() {
    $db=false;
    try {
        $db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER,DB_PASSWORD);
    } catch (PDOException $e) {
    // tenter de réessayer la connexion après un certain délai, par exemple
        echo "C'est la merde Michelle: " . $e;
    };
    return $db;
}
function verifAdmin() {
    if (!isset($_SESSION['user']['roles']) || !in_array('ROLE_ADMIN', json_decode($_SESSION['user']['roles']))) {
        header('Location: ?page=home');
    }
}

function showGlobals() {
    echo "<pre>";
    var_dump($GLOBALS);
    echo "</pre>";
}

function getExtension($file){
    return ".".explode('.', $file)[1];
}

function extensionAutorisee($extension){
    $extensionAutorise = array(".png",".jpg",".jpeg",".gif");
    $bool = false;
    if(in_array($extension, $extensionAutorise)){
        $bool = true;
    }
    return $bool;
}

function isUserConnected() {
    return isset($_SESSION['user']);
}

function getUser($id){
    $db = connectDB();
    $sql = $db->prepare("SELECT * FROM user WHERE id = :id");
    $sql->bindParam(':id', $id);
    $sql->execute();
    $user = $sql->fetch(PDO::FETCH_ASSOC);
    return $user;
}