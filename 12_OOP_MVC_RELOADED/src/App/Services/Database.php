<?php
namespace App\Services;
use PDO;
use PDOException;
require_once('./config.php');
class Database{
    private $db_host;
    private $db_name;
    private $db_port;
    private $db_user;
    private $db_password;

    private $db_dsn;

    private $pdo;
    public function __construct(
        $db_host = DB_HOST,
        $db_name = DB_NAME,
        $db_port = DB_PORT,
        $db_user = DB_USER,
        $db_password = DB_PASSWORD
    )
    {
        $this->db_host = $db_host;
        $this->db_name = $db_name;
        $this->db_port = $db_port;
        $this->db_user = $db_user;
        $this->db_password = $db_password;
        $this->db_dsn = "mysql:host=" . $this->db_host . ";port=" . $this->db_port. ";dbname=" . $this->db_name .';charset=utf8';
    }
    private function getPDO(){
        if($this->pdo === null){
            try {
                $db = new PDO($this->db_dsn, $this->db_user, $this->db_password);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
            // tenter de réessayer la connexion après un certain délai, par exemple
                echo "C'est la merde Michelle: " . iconv('ISO-8859-1','UTF-8',$e-> getMessage());
                die();
            };
            $this->pdo = $db;
        }
        return $this->pdo;
    }

    public function selectAll($statement,$params=[]){
        $sql = $this->getPDO()->prepare($statement);
        $sql->execute($params);
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function select($statement,$params=[]){
        $sql = $this->getPDO()->prepare($statement);
        $sql->execute($params);
        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    public function query($statement,$params=[]){
        $sql = $this->getPDO()->prepare($statement);
        $sql->execute($params);
        return $this->getPDO();
    }
}