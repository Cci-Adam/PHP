<?php
require('../config.php');
session_start();
if(isset($_POST['email']) && isset($_POST['password']) && !empty($_POST['email']) && !empty($_POST['password'])){
    $errors=[];
    $email = htmlentities(strip_tags($_POST['email']));
    $password = htmlentities(strip_tags($_POST['password']));
    $db = connectDB();
    $sql = $db->prepare("SELECT * FROM user join user_details on user.id = user_details.id WHERE email = :email OR username = :email");
    $sql->bindParam(':username', $email);
    $sql->bindParam(':email', $email);
    $sql->execute();
    $user= $sql->fetch(PDO::FETCH_ASSOC);
    $prevPage = $_SERVER['HTTP_REFERER'];
    $prevPage = explode("?", $prevPage);
    $prevPage = '?'.$prevPage[1];
    if(is_array($user) && password_verify($password,$user['password'])){
        $_SESSION['user'] = $user;
        header("Location: ../$prevPage");
    }
    else{
        $errors[]="Mot de passe ou email invalide";
        $_SESSION['err_login'] = "Mot de passe ou email invalide";
        header("Location: ../$prevPage");
    }
}
?>