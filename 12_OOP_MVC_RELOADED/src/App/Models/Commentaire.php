<?php
namespace App\Models;
use App\Models\AbstractTable;

class Commentaire extends AbstractTable{
    protected ?int $user_id = null;
    protected ?int $monstre_id = null;
    protected ?string $commentaire = null;
    private ?string $posted_at = null;

    public function setUser_id(?int $user_id){
        $this->user_id = $user_id;
    }

    public function setMonstre_id(?int $monstre_id){
        $this->monstre_id = $monstre_id;
    }

    public function setCommentaire(?string $commentaire){
        $this->commentaire = $commentaire;
    }

    public function setPosted_at(?string $posted_at){
        $this->posted_at = date('Y-m-d H:i:s');
    }

    public function toArray(){
        $commentaireArray = [
            $this->user_id,
            $this->monstre_id,
            $this->commentaire,
            $this->posted_at
        ];
        return $commentaireArray;
    }
}