<?php
// namespace APP;

// use APP\models;
require_once('./services/class/Database.php');
class Commentaire{
    private $db;
    public function __construct(){
        $this->db = new Database();
    }

    public function getAll(){
        $commentaires = $this->db->selectAll("SELECT *,commentaire.id as id,user.id as user_id FROM commentaire join user on user.id = commentaire.user_id WHERE monstre_id = :id ORDER BY posted_at DESC");
        return $commentaires;
    }

    public function add($commentaire, $user_id, $monstre_id){
        $this->db->query("INSERT INTO commentaire (commentaire, user_id, monstre_id) VALUES (:commentaire, :user_id, :monstre_id)",
        ["commentaire"=>$commentaire, "user_id"=>$user_id, "monstre_id"=>$monstre_id]);
    }

    public function delete($id){
        $this->db->query("DELETE FROM commentaire WHERE id = :id", ["id"=>$id]);
    }
}