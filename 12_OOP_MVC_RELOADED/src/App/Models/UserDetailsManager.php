<?php
namespace App\Models;
use App\Models\UserDetails;
use App\Services\Database;
use App\Models\AbstractManager;

class UserDetailsManager extends AbstractManager
{
    public function __construct()
    {
        self::$db = new Database();
        self::$tableName = "user_details";
        self::$obj = new UserDetails();
    }
}