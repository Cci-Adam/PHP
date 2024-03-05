<?php
namespace App\Models;
use App\Models\Commentaire;
use App\Services\Database;
use App\Models\AbstractManager;

class CommentaireManager extends AbstractManager
{
    public function __construct()
    {
        self::$db = new Database();
        self::$tableName = "commentaire";
        self::$obj = new Commentaire();
    }
}