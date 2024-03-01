<?php
Utils::verifAdmin();
require_once('./models/Monstre.php');
$monstreObj = new Monstre();

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
$els = [
    ["Feu","🔥"],
    ["Foudre","⚡"],
    ["Glace","❄"],
    ["Eau","💧"],
    ["Dragon","🐉"]
];


function getExtensionExists($file){
    return ".".explode('.', $file)[2];
}

$errors = [];
$exists = false;
$nom = "";
$category = "";
$description = "";
$shortDescription = "";
$taille = '["",""]';
$elements = '[]';
$faiblesses = '[]';
$generation = "";
$imgEdit = true;

if (isset($_GET['id'])) {
    $id = htmlentities(strip_tags($_GET['id']));
    $monstre = $monstreObj->getOne($id);
    $nom = $monstre['nom'];
    $category = $monstre['categorie'];
    $description = $monstre['description'];
    $shortDescription = $monstre['short_description'];
    $taille = $monstre['taille'];
    $elements = $monstre['elements'];
    $faiblesses = $monstre['faiblesses'];
    $generation = $monstre['generation'];
    $extension = getExtensionExists($monstre['img']);
    $newFile = $monstre['img'];
    $imgEdit = false;

}

if (isset($_POST['nom']) && isset($_POST['description']) && isset($_POST['category']) && !empty($_POST['nom']) && !empty($_POST['description']) && !empty($_POST['category'])){
    if(isset($_FILES['imgMonstre']) && !empty($_FILES['imgMonstre']['name'])) {
        $extension = Utils::getExtension($_FILES['imgMonstre']['name']);
        $newFile = "./assets/mh_img/".time().$extension;
        $imgEdit = true;
    }
    else if(empty($newFile)){
        $extension = ".jpg";
        $newFile = "./assets/mh_img/addMonster.jpg";
        $imgEdit = true;
    }
    $nom = htmlentities(strip_tags($_POST['nom']));
    $shortDescription = htmlentities(strip_tags($_POST['short_description']));
    $description = htmlentities(strip_tags($_POST['description']));
    $category = htmlentities(strip_tags($_POST['category']));
    $taille=["",""];
    $taille[0] = htmlentities(strip_tags($_POST['taille_min']));
    $taille[1] = htmlentities(strip_tags($_POST['taille_max']));
    $generation = htmlentities(strip_tags($_POST['generation']));
    $elements = [];
    $faiblesses = [];
    if(!empty($_POST['elements'])) {
        foreach ($_POST['elements'] as $element) {
            $elements[] = $element;
        }
    }
    if(!empty($_POST['faiblesses'])) {
        foreach ($_POST['faiblesses'] as $faiblesse) {
            $faiblesses[] = $faiblesse;
        }
    }
    if(!isset($_GET['id'])){
        $query = $db->prepare("SELECT * FROM monstre WHERE nom = :nom");
        $query->bindParam(':nom', $nom);
        $query->execute();
        $exists = $query->fetchColumn();
    }
    if ($exists) {
        $errors[] = "Cet monstre existe déjà";
    }
    if(!Utils::extensionAutorisee($extension)){
        $errors[] = "Extension non autorisee";
    }
    if(empty($errors)) {
        if(isset($_GET['id'])){
            $result = $monstreObj->getOne($id);
            $pathToDelete = $result['img'];
            if($imgEdit && $monstre['img'] != "./assets/mh_img/addMonster.jpg") {
            unlink($pathToDelete);
            };
            $sql = $db->prepare("UPDATE monstre SET nom = :nom, short_description = :short_description, description = :description, img = :img, categorie = :category, last_Updated = NOW() WHERE id = :id");
            $sql->bindParam(':nom', $nom);
            $sql->bindParam(':short_description', $shortDescription);
            $sql->bindParam(':description', $description);
            $sql->bindParam(':img', $newFile);
            $sql->bindParam(':category', $category);
            $sql->bindParam(':id', $id);
            $sql->execute();
           
            $taille = json_encode($taille);
            $elements = json_encode($elements);
            $faiblesses = json_encode($faiblesses);
            $sql = $db->prepare("UPDATE monstre_details SET taille = :taille, elements = :elements, faiblesses = :faiblesses, generation = :generation WHERE id = :id");
            $sql->bindParam(':taille', $taille);
            $sql->bindParam(':elements', $elements);
            $sql->bindParam(':faiblesses', $faiblesses);
            $sql->bindParam(':generation', $generation);
            $sql->bindParam(':id', $id);
           
            $sql->execute();
            move_uploaded_file($_FILES['imgMonstre']['tmp_name'],$newFile);
            header('Location: ?page=admin_monstre_tab');
        }
        else{
            
            $sql = $db->prepare("INSERT INTO monstre (nom, short_description, description, img, categorie) VALUES (:nom, :short_description,:description, :img, :category)");
            $sql->bindParam(':nom', $nom);
            $sql->bindParam(':short_description', $shortDescription);
            $sql->bindParam(':description', $description);
            $sql->bindParam(':img', $newFile);
            $sql->bindParam(':category', $category);
            $sql->execute();
            $taille = json_encode($taille);
            $elements = json_encode($elements);
            $faiblesses = json_encode($faiblesses);
            $sql = $db->prepare("INSERT INTO monstre_details (taille, elements, faiblesses, generation) VALUES (:taille, :elements, :faiblesses, :generation)");
            $sql->bindParam(':taille', $taille);
            $sql->bindParam(':elements', $elements);
            $sql->bindParam(':faiblesses', $faiblesses);
            $sql->bindParam(':generation', $generation);
            $sql->execute();
            move_uploaded_file($_FILES['imgMonstre']['tmp_name'],$newFile);
            $nom = "";
            $category = "";
            $description = "";
            $shortDescription = "";
            $taille = '["",""]';
            $elements = '[]';
            $faiblesses = '[]';
            $generation = "";
        }
    }
}


include "./views/base.phtml";
?>