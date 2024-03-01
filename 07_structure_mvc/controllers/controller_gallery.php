<?php
require_once('./models/Monstre.php');
$categories = [
    "Herbivore",
    "Lynien",
    "Poisson",
    "Neopteron",
    "Carapaceon",
    "Temnoceran",
    "Amphibien",
    "Leviathan",
    "Bete a croc",
    "Wyverne volante",
    "Wyverne rapace",
    "Wyverne de terre",
    "Wyverne a crocs",
    "Wyverne aquatique",
    "Wyverne serpent",
    "Dragon ancien",
    "Inclassable",
    "???"];

$monstreObj = new Monstre();
if(Utils::isUserConnected()) {

$user = Utils::getUser($_SESSION['user']['id']);
}

function keepSearch() {
    if (isset($_GET['keywords'])) {
        return "&keywords=".$_GET['keywords'];
    }
    if(isset($_GET['favori'])) {
        return "&favori=true";
    }
    if(isset($_GET['category'])) {
        return "&category=".$_GET['category'];
    }
}

isset($_GET['pagination']) ? $pagination = $_GET['pagination'] : $pagination = 1;	
isset($_GET['keywords']) ? $keywords = $_GET['keywords'] : $keywords = '';
isset($_GET['category']) ? $category = $_GET['category'] : $category = '';
$keywords = strip_tags(urldecode(trim($keywords)));
    $offset = ($pagination-1) * 6;
    if(isset($_GET['category'])) {
        $monstres = $monstreObj->getAllByCategorie(null,$keywords,$category);
    }
    else if(isset($_GET['favori'])) {
        $favori = json_decode($user['favori']);
        $monstres = $monstreObj->getAll(null,$keywords);
        foreach($monstres as $key => $monstre) {
            if(!in_array($monstre['id'], $favori)) {
                unset($monstres[$key]);
            }
        }
    }
    else {
        $monstres = $monstreObj->getAll(null,$keywords);
    }
    $count = count($monstres);
        $monstres = array_slice($monstres, $offset, 6);
include "./views/base.phtml";
?>