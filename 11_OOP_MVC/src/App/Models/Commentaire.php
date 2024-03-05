<?php
namespace App\Models;
use App\Services\Database;


class Commentaire{
    private $db;
    public function __construct(){
        $this->db = new Database();
    }

    public function getAllByMonstre($id){
        $commentaires = $this->db->selectAll("SELECT *,commentaire.id as id,user.id as user_id FROM commentaire join user on user.id = commentaire.user_id WHERE monstre_id = :id ORDER BY posted_at DESC",
        ["id"=>$id]);
        return $commentaires;
    }

    public function add($commentaire, $user_id, $monstre_id){
        $this->db->query("INSERT INTO commentaire (commentaire, user_id, monstre_id) VALUES (:commentaire, :user_id, :monstre_id)",
        ["commentaire"=>$commentaire, "user_id"=>$user_id, "monstre_id"=>$monstre_id]);
    }

    public function update($id, $commentaire){
        $this->db->query("UPDATE commentaire SET commentaire = :commentaire WHERE id = :id",
        ["commentaire"=>$commentaire, "id"=>$id]);
    }

    public function delete($id){
        $this->db->query("DELETE FROM commentaire WHERE id = :id",["id"=>$id]);
    }
}