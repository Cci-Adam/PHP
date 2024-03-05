<?php
namespace App\Models;
use App\Services\Database;

class Contact
{
    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }
    public function add($id, $sujet, $message){
        $this->db->query("INSERT INTO contact (user_id, sujet, message) VALUES (:user_id, :sujet, :message)",
        ["user_id"=>$id, "sujet"=>$sujet, "message"=>$message]);
    }
}