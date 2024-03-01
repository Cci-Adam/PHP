<?php

class Voiture{
    public $marque = "";
    public $modele = "";
    public $energie = "";
    public $couleur = "";
    private $qt_energie = 30;

    public function __construct($marque, $modele, $energie, $couleur)
    {
        $this->marque = $marque;
        $this->modele = $modele;
        $this->energie = $energie;
        $this->couleur = $couleur;

    }

    public function demarrer()
    {
        echo "vroum vroum";
        $this ->qt_energie -= 10;
    }

    public function getQtEnergie()
    {
        return $this->qt_energie;
    }
}