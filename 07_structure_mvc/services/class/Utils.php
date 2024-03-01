<?php
class Utils{
    static function connectDB() {
        $db=false;
        try {
            $db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER,DB_PASSWORD);
        } catch (PDOException $e) {
        // tenter de réessayer la connexion après un certain délai, par exemple
            echo "C'est la merde Michelle: " . $e;
        };
        return $db;
    }
    
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
        $db = self::connectDB();
        $sql = $db->prepare("SELECT * FROM user WHERE id = :id");
        $sql->bindParam(':id', $id);
        $sql->execute();
        $user = $sql->fetch(PDO::FETCH_ASSOC);
        return $user;
    }
}