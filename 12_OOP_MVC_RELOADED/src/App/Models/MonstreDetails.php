<?php
namespace App\Models;
use App\Models\AbstractTable;

class MonstreDetails extends AbstractTable
{
    protected ?int $monstre_id = null;
    protected ?array $elements = null;
    protected ?array $faiblesses = null;
    protected ?array $taille = null;
    protected ?int $generation = null;

    public function setMonstre_id(?int $monstre_id){
        $this->monstre_id = $monstre_id;
    }
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

    public function toArray(){
        $monstreDetailsArray = [
            $this->monstre_id,
            $this->elements,
            $this->faiblesses,
            $this->taille,
            $this->generation
        ];
        return $monstreDetailsArray;
    }
}