<?php
namespace App\Controllers;
use App\Models\Monstre;
use App\Services\Utils;
class GalleryController
{
    public function index()
    {
        $template = './views/template_gallery.phtml';
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
        $user = null;
        if(Utils::isUserConnected()) {

            $user = Utils::getUser($_SESSION['user']['id']);
        }
        isset($_GET['pagination']) ? $pagination = $_GET['pagination'] : $pagination = 1;	
        isset($_GET['keywords']) ? $keywords = $_GET['keywords'] : $keywords = '';
        isset($_GET['category']) ? $category = $_GET['category'] : $category = '';
        $keywords = strip_tags(urldecode(trim($keywords)));
        $offset = ($pagination-1) * 6;
        if(isset($_GET['category'])) {
            $monstres = $monstreObj->getAllByCategorie(null,$keywords,$category);
        }
        else {
            $monstres = $monstreObj->getAll(null,$keywords);
        }
        $count = count($monstres);
        $monstres = array_slice($monstres, $offset, 6);
        $this->render($template,["monstres"=>$monstres,"categories"=>$categories,"pagination"=>$pagination,"keywords"=>$keywords,"category"=>$category,"count"=>$count,"user"=>$user]);
    }

    public function render($templatePath, $data) {
        ob_start();
        include $templatePath;
        $template = ob_get_clean();
        include './views/base.phtml';
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



