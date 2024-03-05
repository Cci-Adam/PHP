<?php
namespace App\Models;
use App\Models\AbstractTable;

class MonstreDetails extends AbstractTable
{
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

    public function toArray(){
        $monstreDetailsArray = [
            $this->elements,
            $this->faiblesses,
            $this->taille,
            $this->generation
        ];
        return $monstreDetailsArray;
    }
}