<?php
namespace App\Models;
use App\Models\AbstractTable;

class Contact extends AbstractTable
{
    protected ?int $user_id = null;
    protected ?string $sujet = null;
    protected ?string $message = null;

    public function setUser_id(?int $user_id){
        $this->user_id = $user_id;
    }

    public function setSujet(?string $sujet){
        $this->sujet = $sujet;
    }

    public function setMessage(?string $message){
        $this->message = $message;
    }

    public function toArray(){
        $contactArray = [
            $this->user_id,
            $this->sujet,
            $this->message
        ];
        return $contactArray;
    }
}