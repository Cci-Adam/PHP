<?php
namespace App\Models;
use App\Services\Database;
class User{
    private $db;
    public function __construct(){
        $this->db = new Database();
    }


    public function getAll(){
        $users = $this->db->selectAll("SELECT *,user.id as id FROM user JOIN user_details ON user_details.user_id = user.id");
        return $users;
    }

    public function getOneByID($id){
        $user = $this->db->select("SELECT *,user.id as id FROM user JOIN user_details ON user_details.user_id = user.id WHERE user.id = :id", ["id"=>$id]);
        return $user;
    }

    public function getOneByLogin($email){
        $user = $this->db->select("SELECT *,user.id as id FROM user JOIN user_details ON user_details.user_id = user.id WHERE username = :email OR email = :email", 
        ["email"=>$email]);
        return $user;
    }

    public function alreadyExists($email, $username){
        $user = $this->db->select("SELECT * FROM user WHERE username = :username OR email = :email",
        ["username"=>$username, "email"=>$email]);
        return $user;
    }

    public function add($email, $password, $username, $avatar){
        $query = $this->db->query("INSERT INTO user (email, password, username, avatar) VALUES (:email, :password, :username, :avatar)",
        ["email"=>$email, "password"=>$password, "username"=>$username, "avatar"=>$avatar]);
        return $query;
    }

    public function addDetails($firstname, $lastname, $address1, $address2, $zip, $city, $state, $user_id){
        $query = $this->db->query("INSERT INTO user_details (firstname, lastname, address1, address2, zip, city, state, user_id) 
        VALUES (:firstname, :lastname, :address1, :address2, :zip, :city, :state, :user_id)",
        ["firstname"=>$firstname, "lastname"=>$lastname, "address1"=>$address1, "address2"=>$address2, "zip"=>$zip, "city"=>$city, "state"=>$state, "user_id"=>$user_id]);
        return $query;
    }

    public function update($id, $email, $username, $avatar, $password, $firstname, $lastname, $address1, $address2, $zip, $city, $state){
        $this->db->query("UPDATE user SET email = :email, username = :username, avatar = :avatar, password = :password WHERE id = :id",
        ["email"=>$email, "username"=>$username, "avatar"=>$avatar, "id"=>$id, "password"=>$password]);
        $this->db->query("UPDATE user_details SET firstname = :firstname, lastname = :lastname, address1 = :address1, address2 = :address2, 
        zip = :zip, city = :city, state = :state WHERE user_id = :id",
        ["firstname"=>$firstname, "lastname"=>$lastname, "address1"=>$address1, "address2"=>$address2, "zip"=>$zip, "city"=>$city, "state"=>$state, "id"=>$id]);
    }

    public function updateAdmin($id, $email, $username, $roles, $firstname, $lastname, $address1, $address2, $zip, $city, $state){
        $this->db->query("UPDATE user SET email = :email, roles = :roles, username = :username WHERE id = :id",
        ["email"=>$email, "roles"=>$roles, "username"=>$username, "id"=>$id]);
        $this->db->query("UPDATE user_details SET firstname = :firstname, lastname = :lastname, address1 = :address1, address2 = :address2,
        zip = :zip, city = :city, state = :state WHERE user_id = :id",
        ["firstname"=>$firstname, "lastname"=>$lastname, "address1"=>$address1, "address2"=>$address2, "zip"=>$zip, "city"=>$city, "state"=>$state, "id"=>$id]);
    }

    public function updateFavori($id, $favori){
        $this->db->query("UPDATE user SET favori = :favori WHERE id = :id",
        ["favori"=>$favori, "id"=>$id]);
    }

    public function delete($id){
        $this->db->query("DELETE FROM user_details WHERE user_id = :id",
        ["id"=>$id]);
        $this->db->query("DELETE FROM user WHERE id = :id",
        ["id"=>$id]);
    }
}