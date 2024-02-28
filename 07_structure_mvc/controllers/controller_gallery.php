<?php
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
$db = connectDB();
if(isUserConnected()) {

$user = getUser($_SESSION['user']['id']);
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
if ($db) {

    $offset = ($pagination-1) * 6;
    if(isset($_GET['category'])) {
        $sql = $db->prepare("SELECT * FROM monstre WHERE (nom LIKE '%$keywords%' OR description LIKE '%$keywords%') AND categorie = :category");
        $sql->bindParam(':category', $category);
        $sql->execute();
        $monstres= $sql->fetchAll(PDO::FETCH_ASSOC);
        $count = count($monstres);
        $monstres = array_slice($monstres, $offset, 6);
    }
    else if(isset($_GET['favori'])) {
        $favori = json_decode($user['favori']);
        $sql = $db->prepare("SELECT * FROM monstre");
        $sql->execute();
        $monstres= $sql->fetchAll(PDO::FETCH_ASSOC);
        foreach($monstres as $key => $monstre) {
            if(!in_array($monstre['id'], $favori)) {
                unset($monstres[$key]);
            }
        }
        $count = count($monstres);
        $monstres = array_slice($monstres, $offset, 6);
    }
    else {
        $sql = $db->prepare("SELECT * FROM monstre WHERE nom LIKE '%$keywords%' OR description LIKE '%$keywords%'");
        $sql->execute();
        $monstres= $sql->fetchAll(PDO::FETCH_ASSOC);
        $count = count($monstres);
        $monstres = array_slice($monstres, $offset, 6);
    }
    
}
include "./views/base.phtml";
?>