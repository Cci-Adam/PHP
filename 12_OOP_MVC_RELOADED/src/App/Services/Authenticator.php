<?php 
namespace App\Services;
use App\Models\UserManager;

class Authenticator
{
    public function __construct()
    {
        if(!isset($_SESSION)) session_start();
    }

    private function setSession($userData){
        $_SESSION['user'] = $userData;
    }

    public function login($email, $password){
        $isLogged = false;
        $user = (new UserManager())->getUserByLogin($email);
        if($user){
            $isLogged = password_verify($password, $user['password']);
        }
        if($isLogged){
            $this->setSession($user);
        }
        return $isLogged;
    }

    public function logout(){
        session_destroy();
        $prevPage = $_SERVER['HTTP_REFERER'];
        $prevPage = explode("?", $prevPage);
        $prevPage = '?'.$prevPage[1];
        header('Location: ./'.$prevPage);
    }

    static function isRole($role) {
        return isset($_SESSION['user']) && in_array($role, json_decode($_SESSION['user']['roles']));
    }
}