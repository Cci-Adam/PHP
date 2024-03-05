<?php
namespace App\Controllers;
use App\Models\MonstreManager;
use App\Services\Utils;
use App\Controllers\Controller;

class AdminAddMonstreController extends Controller {
    public function index(){
        $utilsObj = new Utils();
        $utilsObj->verifAdmin();
        $monstreObj = new MonstreManager();
        $errors = [];
        $exists = false;
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
            $imgEdit = true;
            $monstre = ['elements'=>'[]', 'faiblesses'=>'[]', 'categorie'=>'', 'generation'=>''];
            if (isset($_GET['id'])) {
                $id = htmlentities(strip_tags($_GET['id']));
                $monstre = $monstreObj->getOneById($id);
                $extension = $this->getExtensionExists($monstre['img']);
                $newFile = $monstre['img'];
                $imgEdit = false;
            }
        
            if (isset($_POST['nom']) && isset($_POST['description']) && isset($_POST['category']) && !empty($_POST['nom']) && !empty($_POST['description']) && !empty($_POST['category'])){
                if(isset($_FILES['imgMonstre']) && !empty($_FILES['imgMonstre']['name'])) {
                    $extension = $utilsObj->getExtension($_FILES['imgMonstre']['name']);
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
                var_dump($_GET['id']);
                if(!isset($_GET['id'])){
                    $exists = $monstreObj->getOneById(null,"SELECT * FROM monstre WHERE nom = '$nom'");
                }
                if ($exists) {
                    $errors[] = "Cet monstre existe déjà";
                }
                if(!Utils::extensionAutorisee($extension)){
                    $errors[] = "Extension non autorisee";
                }
                if(empty($errors)) {
                        $taille = json_encode($taille);
                        $elements = json_encode($elements);
                        $faiblesses = json_encode($faiblesses);
                        
                        if(isset($_GET['id'])){
                        $result = $monstreObj->getOneById($id);
                        $pathToDelete = $result['img'];
                        if($imgEdit && $monstre['img'] != "./assets/mh_img/addMonster.jpg") {
                            unlink($pathToDelete);
                        };
                        $monstreObj->update($id, $nom, $shortDescription, $description, $newFile, $category, $taille, $elements, $faiblesses, $generation);
                        move_uploaded_file($_FILES['imgMonstre']['tmp_name'],$newFile);
                        header('Location: ?page=adminmonstretab');
                    }
                    else{
                        $ajout = $monstreObj->add($nom, $shortDescription, $description, $newFile, $category);
                        $monstre_id = $ajout->lastInsertId();
                        $monstreObj->addDetails($monstre_id, $taille, $elements, $faiblesses, $generation);
                        move_uploaded_file($_FILES['imgMonstre']['tmp_name'],$newFile);
                        header('Location: ?page=adminmonstretab');
                    }
                }
                else{
                    header('Location: ?page=adminmonstretab');
                }
            }
        
        $template = './views/template_admin_add_monstre.phtml';
        $this->render($template,['monstre'=>$monstre,'categories'=>$categories,'els'=>$els]);
    }

    function getExtensionExists($file){
        return ".".explode('.', $file)[2];
    }
}