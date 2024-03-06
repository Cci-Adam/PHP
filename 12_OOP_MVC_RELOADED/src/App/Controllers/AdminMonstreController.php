<?php
namespace App\Controllers;
use App\Models\MonstreManager;
use App\Models\MonstreDetailsManager;
use App\Models\CommentaireManager;
use App\Controllers\Controller;
use App\Services\Utils;


class AdminMonstreController extends Controller
{
    public function index()
    {
        $utilsObj = new Utils();
        $utilsObj->verifAdmin();
        $monstreObj = new MonstreManager();
        $monstres = $monstreObj->getAll();
        $template = './views/template_admin_monstre_tab.phtml';
        $this->render($template,['monstres' => $monstres]);
    }

    public function delete()
    {
            $id = $_GET['id'];
            $commentaireObj = new CommentaireManager();
            $commentaireObj->delete(null, "DELETE FROM commentaire WHERE monstre_id = $id");
            $monstreDetailsObj = new MonstreDetailsManager();
            $monstreDetailsObj->delete(null, "DELETE FROM monstre_details WHERE monstre_id = $id");
            $monstreObj = new MonstreManager();
            // On va supprimer l'image
            $monstre = $monstreObj->getOneById($id);
            $pathToDelete = $monstre['img'];
            if ($pathToDelete != './assets/mh_img/addMonster.jpg') {
            unlink($pathToDelete);
            }
            // Suppression des commentaires, details et du monstre
            $monstreObj->delete($id);
            header('Location: ?page=adminmonstre');
    }

    public function insert()
    {
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
        if (isset($_POST['nom']) && isset($_POST['description']) && isset($_POST['category']) && !empty($_POST['nom']) && !empty($_POST['description']) && !empty($_POST['category'])){
            if(isset($_FILES['imgMonstre']) && !empty($_FILES['imgMonstre']['name'])) {
                $extension = $utilsObj->getExtension($_FILES['imgMonstre']['name']);
                $newFile = "./assets/mh_img/".time().$extension;
                $imgEdit = true;
            }
            else {
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
            $exists = $monstreObj->getOneById(null,"SELECT * FROM monstre WHERE nom = '$nom'");
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
                $ajout = $monstreObj->insert([$nom, $category, $shortDescription, $description, $newFile, date('Y-m-d H:i:s')]);
                $monstre_id = $ajout->lastInsertId();
                $monstreDetailsObj = new MonstreDetailsManager();
                $monstreDetailsObj->insert([$monstre_id, $elements ,$faiblesses ,$taille , $generation]);
                move_uploaded_file($_FILES['imgMonstre']['tmp_name'],$newFile);
                header('Location: ?page=adminmonstre');
            }
        }
        $template = './views/template_admin_add_monstre.phtml';
        $this->render($template,['monstre'=>$monstre,'categories'=>$categories,'els'=>$els]);
    }

    public function edit(){
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
        $id = htmlentities(strip_tags($_GET['id']));
        $monstre = $monstreObj->getOneById(null, "SELECT * FROM monstre join monstre_details on monstre.id = monstre_details.monstre_id WHERE monstre.id = $id");
        $extension = $this->getExtensionExists($monstre['img']);
        $newFile = $monstre['img'];
        $imgEdit = false;
        if (isset($_POST['nom']) && isset($_POST['description']) && isset($_POST['category']) && !empty($_POST['nom']) && !empty($_POST['description']) && !empty($_POST['category'])){
            if(isset($_FILES['imgMonstre']) && !empty($_FILES['imgMonstre']['name'])) {
                $extension = $utilsObj->getExtension($_FILES['imgMonstre']['name']);
                $newFile = "./assets/mh_img/".time().$extension;
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
                $result = $monstreObj->getOneById($id);
                $pathToDelete = $result['img'];
                if($imgEdit && $monstre['img'] != "./assets/mh_img/addMonster.jpg") {
                    unlink($pathToDelete);
                };
                $date = date('Y-m-d H:i:s');
                $monstreObj->update("UPDATE monstre SET nom = '$nom', categorie = '$category', short_description = '$shortDescription', description = '$description', img = '$newFile', updated_at = '$date' WHERE id = $id");
                $monstreDetailsObj = new MonstreDetailsManager();
                $monstreDetailsObj->update("UPDATE monstre_details SET elements = '$elements', faiblesses = '$faiblesses', taille = '$taille', generation = '$generation' WHERE monstre_id = $id");
                move_uploaded_file($_FILES['imgMonstre']['tmp_name'],$newFile);
                header('Location: ?page=adminmonstre');
            }
        }
        $template = './views/template_admin_add_monstre.phtml';
        $this->render($template,['monstre'=>$monstre,'categories'=>$categories,'els'=>$els]);
    }

    function getExtensionExists($file){
        return ".".explode('.', $file)[2];
    }
}