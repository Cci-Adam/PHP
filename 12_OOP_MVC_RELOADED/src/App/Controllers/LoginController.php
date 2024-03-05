<?php
namespace App\Controllers;
use App\Services\Authenticator;
class LoginController{
    public function index(){
        
        if(isset($_POST['email']) && isset($_POST['password']) && !empty($_POST['email']) && !empty($_POST['password'])){
            $errors=[];
            $email = htmlentities(strip_tags($_POST['email']));
            $password = htmlentities(strip_tags($_POST['password']));
            $auth = new Authenticator();
            $prevPage = $_SERVER['HTTP_REFERER'];
            $prevPage = explode("?", $prevPage);
            $prevPage = '?'.$prevPage[1];
            var_dump($prevPage);
            if($auth->login($email,$password)){
            }
            else{
                $errors[]="Mot de passe ou email invalide";
                $_SESSION['err_login'] = "Mot de passe ou email invalide";
            }
            header("Location: ./$prevPage");
        }
    }
}