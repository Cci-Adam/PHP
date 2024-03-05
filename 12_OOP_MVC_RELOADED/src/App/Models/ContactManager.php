<?php
namespace App\Models;
use App\Models\Contact;
use App\Services\Database;
use App\Models\AbstractManager;

class ContactManager extends AbstractManager
{
    public function __construct()
    {
        self::$db = new Database();
        self::$tableName = "contact";
        self::$obj = new Contact();
    }
}