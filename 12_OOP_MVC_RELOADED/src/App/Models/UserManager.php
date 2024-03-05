<?php
namespace App\Models;
use App\Models\User;
use App\Services\Database;
use App\Models\AbstractManager;

class UserManager extends AbstractManager
{
    public function __construct()
    {
        self::$db = new Database();
        self::$tableName = "user";
        self::$obj = new User();
    }

    public function getUserByLogin ($email = null): array|false
    {
        $where = !is_null($email) ? "WHERE email = ? OR username = ?" : "";
        $row = [];
        $row = self::$db->select("SELECT *,user.id as id FROM ".self::$tableName." JOIN user_details on user.id = user_id ".$where." LIMIT 1",[$email,$email]);
        return $row;
    }
}