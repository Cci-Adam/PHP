<?php
require_once('./models/User.php');
$userObj = new User();
session_start();
if(isset($_POST['email']) && isset($_POST['password']) && !empty($_POST['email']) && !empty($_POST['password'])){
    $errors=[];
    $email = htmlentities(strip_tags($_POST['email']));
    $password = htmlentities(strip_tags($_POST['password']));
    $user = $userObj->getOneByLogin($email);
    $prevPage = $_SERVER['HTTP_REFERER'];
    $prevPage = explode("?", $prevPage);
    $prevPage = '?'.$prevPage[1];
    var_dump($prevPage);
    if(is_array($user) && password_verify($password,$user['password'])){
        $_SESSION['user'] = $user;
        
    }
    else{
        $errors[]="Mot de passe ou email invalide";
        $_SESSION['err_login'] = "Mot de passe ou email invalide";
    }
    header("Location: ./$prevPage");
}

?>