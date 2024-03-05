<?php
namespace App\Models;
use App\Models\AbstractTable;

class UserDetails extends AbstractTable{
    private ?int $user_id = null;
    private ?string $firstname = null;
    private ?string $lastname = null;
    private ?string $address1 = null;
    private ?string $address2 = null;
    private ?string $zip = null;
    private ?string $city = null;
    private ?string $state = null;

    public function setUser_id(?int $user_id){
        $this->user_id = $user_id;
    }

    public function setFirstname(?string $firstname){
        $this->firstname = $firstname;
    }

    public function setLastname(?string $lastname){
        $this->lastname = $lastname;
    }

    public function setAddress1(?string $address1){
        $this->address1 = $address1;
    }

    public function setAddress2(?string $address2){
        $this->address2 = $address2;
    }

    public function setZip(?string $zip){
        $this->zip = $zip;
    }

    public function setCity(?string $city){
        $this->city = $city;
    }

    public function setState(?string $state){
        $this->state = $state;
    }

    public function toArray(){
        $userDetailsArray = [
            $this->user_id,
            $this->firstname,
            $this->lastname,
            $this->address1,
            $this->address2,
            $this->zip,
            $this->city,
            $this->state
        ];
        return $userDetailsArray;
    }
}