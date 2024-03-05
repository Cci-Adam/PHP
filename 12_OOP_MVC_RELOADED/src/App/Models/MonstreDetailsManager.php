<?php
namespace App\Models;
use App\Models\MonstreDetails;
use App\Services\Database;
use App\Models\AbstractManager;

class MonstreDetailsManager extends AbstractManager
{
    public function __construct()
    {
        self::$db = new Database();
        self::$tableName = "monstre_details";
        self::$obj = new MonstreDetails();
    }
}