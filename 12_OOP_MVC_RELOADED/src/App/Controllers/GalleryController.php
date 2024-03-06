<?php
namespace App\Controllers;
use App\Models\MonstreManager;
use App\Services\Utils;
use App\Controllers\Controller;
class GalleryController extends Controller
{
    public function index()
    {
        $template = './views/template_gallery.phtml';
        $user = null;
        if(Utils::isUserConnected()) {

            $user = Utils::getUser($_SESSION['user']['id']);
        }
        $monstreObj = new MonstreManager();
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
        isset($_GET['pagination']) ? $pagination = $_GET['pagination'] : $pagination = 1;	
        isset($_GET['keywords']) ? $keywords = $_GET['keywords'] : $keywords = '';
        isset($_GET['category']) ? $category = $_GET['category'] : $category = '';
        $keywords = strip_tags(urldecode(trim($keywords)));
        $offset = ($pagination-1) * 6;
        if(isset($_GET['category'])) {
            $monstres = $monstreObj->getAll(null,"SELECT * FROM monstre where categorie = '".$category."'");
        }
        else if(isset($_GET['favori'])) {
            $favori = json_decode($user['favori']);
            $monstres = $monstreObj->getAll();
            foreach($monstres as $key => $monstre) {
                if(!in_array($monstre['id'], $favori)) {
                    unset($monstres[$key]);
                }
            }
        }
        else {
            $monstres = $monstreObj->getAll(null,"SELECT * FROM monstre WHERE nom LIKE '%$keywords%'");
        }
        $count = count($monstres);
        if(isset($_GET['q'])) {
            $monstres = $this->search();
        }
        $monstres = array_slice($monstres, $offset, 6);
        $this->render($template,["monstres"=>$monstres,"categories"=>$categories,"pagination"=>$pagination,"keywords"=>$keywords,"category"=>$category,"count"=>$count,"user"=>$user]);
    }

    public function search(){
        $keywords = $_GET['q'];
        $monstreObj = new MonstreManager();
        $monstres = $monstreObj->getAll(null,"SELECT * FROM monstre WHERE nom LIKE '%$keywords%'");
        foreach($monstres as $key => $monstre) {
            echo "<a href= ?page=monstredetails&id=" . $monstre['id'] . ">" . $monstre['nom'] . "</a><br>";
        }
        return $monstres;
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
}



