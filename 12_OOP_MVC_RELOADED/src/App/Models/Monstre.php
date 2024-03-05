<?php 
namespace App\Models;
use App\Models\AbstractTable;

class Monstre extends AbstractTable{
    protected ?string $nom = null;
    protected ?string $categorie = null;
    protected ?string $short_description = null;
    protected ?string $description = null;
    protected ?string $img = null;
    private ?string $created_at = null;
    protected ?string $updated_at = null;

    public function setNom (?string $nom){
        $this->nom = $nom;
    }

    public function setCategorie(?string $categorie){
        $this->categorie = $categorie;
    }

    public function setShortDescription(?string $short_description){
        $this->short_description = $short_description;
    }

    public function setDescription(?string $description){
        $this->description = $description;
    }

    public function setImg(?string $img){
        $this->img = $img;
    }

    public function setCreatedAt(){
        $this->created_at = date('Y-m-d H:i:s');
    }

    public function setUpdatedAt(){
        $this->updated_at = date('Y-m-d H:i:s');
    }
    
    public function toArray(){
        $monstreArray = [
            $this->nom,
            $this->categorie,
            $this->short_description,
            $this->description,
            $this->img,
            $this->created_at,
            $this->updated_at
        ];
        return $monstreArray;
    }
}


/*

protected ?array $elements = null;
protected ?array $faiblesses = null;
protected ?array $taille = null;
protected ?int $generation = null;

public function setElements(?array $elements){
    $this->elements = $elements;
}

public function setFaiblesses(?array $faiblesses){
    $this->faiblesses = $faiblesses;
}

public function setTaille(?array $taille){
    $this->taille = $taille;
}

public function setGeneration(?int $generation){
    $this->generation = $generation;
}


$this->elements,
$this->faiblesses,
$this->taille,
$this->generation
*/
