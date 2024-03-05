<?php
namespace App\Services;
use App\Models\UserManager;
class Utils{
    static function isRole($role) {
        return isset($_SESSION['user']) && in_array($role, json_decode($_SESSION['user']['roles']));
    }
    
    static function verifAdmin() {
        if (!isset($_SESSION['user']['roles']) || !in_array('ROLE_ADMIN', json_decode($_SESSION['user']['roles']))) {
            header('Location: ?page=home');
        }
    }
    
    static function showGlobals() {
        echo "<pre>";
        var_dump($GLOBALS);
        echo "</pre>";
    }
    
    static function getExtension($file){
        return ".".explode('.', $file)[1];
    }
    
    static function extensionAutorisee($extension){
        $extensionAutorise = array(".png",".jpg",".jpeg",".gif");
        $bool = false;
        if(in_array($extension, $extensionAutorise)){
            $bool = true;
        }
        return $bool;
    }
    
    static function isUserConnected() {
        return isset($_SESSION['user']);
    }
    static function getUser($id){
        $userObj = new UserManager();
        $user = $userObj->getOneById($id);
        return $user;
    }
}