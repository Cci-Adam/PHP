<?php
namespace App\Models;
use App\Models\AbstractTable;

class User extends AbstractTable{
    protected ?string $username = null;
    protected ?string $email = null;
    protected ?string $password = null;
    protected ?array $roles = null;
    protected ?string $avatar = null;
    protected ?array $favori = null;
    private ?string $register_at = null;

    public function setUsername (?string $username){
        $this->username = $username;
    }

    public function setEmail (?string $email){
        $this->email = $email;
    }
    
    public function setPassword (?string $password){
        $this->password = $password;
    }

    public function setRoles (?array $roles){
        $this->roles = $roles;
    }

    public function setAvatar (?string $avatar){
        $this->avatar = $avatar;
    }

    public function setFavori (?array $favori){
        $this->favori = $favori;
    }

    public function setRegister_at (){
        $this->register_at = date('Y-m-d H:i:s');
    }

    public function toArray(){
        $userArray = [
            $this->username,
            $this->email,
            $this->password,
            $this->roles,
            $this->avatar,
            $this->favori,
            $this->register_at
        ];
        return $userArray;
    }
}