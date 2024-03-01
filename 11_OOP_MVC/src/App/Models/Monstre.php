<?php 
namespace App\Models;
use App\Services\Database;
class Monstre{
    private $db;
    public function __construct(){
        $this->db = new Database();
        
    }
    public function getAll($nb=null,$keywords=""){
        $limit = !is_null($nb) ? ' LIMIT '.$nb : '';
        $monstres = $this->db->selectAll("SELECT * FROM monstre WHERE nom LIKE '%$keywords%' OR description LIKE '%$keywords%' ".$limit,[]);
        return $monstres;
    }

    public function getAllByCategorie($nb=null,$keywords="",$category=""){
        $limit = !is_null($nb) ? ' LIMIT '.$nb : '';
        $monstres = $this->db->selectAll("SELECT * FROM monstre WHERE (nom LIKE '%$keywords%' OR description LIKE '%$keywords%') AND categorie = :category ". $limit,["category"=>$category]);
        return $monstres;

    }
    
    public function getOne($id) {
        $monstre = $this->db->select("SELECT * FROM monstre join monstre_details on monstre_details.id = monstre.id WHERE monstre.id = :id",["id"=>$id]);
        return $monstre;
    }

    public function getOnebyName($nom){
        $monstre = $this->db->select("SELECT * FROM monstre WHERE nom = :nom",["nom"=>$nom]);
        return $monstre;
    }

    public function add($nom, $shortDescription, $description, $img, $category){
        $query = $this->db->query("INSERT INTO monstre (nom, short_description, description, img, categorie) VALUES (:nom, :short_description,:description, :img, :category)",
        ["nom"=>$nom, "short_description"=>$shortDescription, "description"=>$description, "img"=>$img, "category"=>$category]);
        return $query;
    }

    public function addDetails($id, $taille, $elements, $faiblesses, $generation){
        $query = $this->db->query("INSERT INTO monstre_details (id, taille, elements, faiblesses, generation) VALUES (:id, :taille, :elements, :faiblesses, :generation)",
        ["id"=>$id, "taille"=>$taille, "elements"=>$elements, "faiblesses"=>$faiblesses, "generation"=>$generation]);
        return $query;
    }

    public function update($id, $nom, $shortDescription, $description, $img, $category, $taille, $elements, $faiblesses, $generation){
        $this->db->query("UPDATE monstre SET nom = :nom, short_description = :short_description, description = :description, img = :img, categorie = :category, last_Updated = NOW() WHERE id = :id",
        ["nom"=>$nom, "short_description"=>$shortDescription, "description"=>$description, "img"=>$img, "category"=>$category, "id"=>$id]);
        $this->db->query("UPDATE monstre_details SET taille = :taille, elements = :elements, faiblesses = :faiblesses, generation = :generation WHERE id = :id",
        ["taille"=>$taille, "elements"=>$elements, "faiblesses"=>$faiblesses, "generation"=>$generation, "id"=>$id]);
        
    }
    public function delete($id){
        $this->db->query("DELETE FROM commentaire WHERE monstre_id = :id",["id"=>$id]);
        $this->db->query("DELETE FROM monstre_details WHERE id = :id",["id"=>$id]);
        $this->db->query("DELETE FROM monstre WHERE id = :id",["id"=>$id]);
    }
}