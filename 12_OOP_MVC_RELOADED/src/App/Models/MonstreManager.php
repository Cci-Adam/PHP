<?php
namespace App\Models;
use App\Models\Monstre;
use App\Services\Database;
use App\Models\AbstractManager;

class MonstreManager extends AbstractManager
{
    public function __construct()
    {
        self::$db = new Database();
        self::$tableName = "monstre";
        self::$obj = new Monstre();
    }
}