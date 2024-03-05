<?php
namespace App\Controllers;
use App\Models\Monstre;
use App\Models\User;
use App\Models\Commentaire;
use App\Services\Utils;

class MonstreDetailsController {
    
    public function index(){
        $monstreObj = new Monstre();
        $userObj = new User();
        $commentaireObj = new Commentaire();
        $utilsObj = new Utils();
        $id = $_GET['id'];
        $favori = null;
        if ($utilsObj->isUserConnected()) {
            $user = $utilsObj->getUser($_SESSION['user']['id']);
            $user_id = $user['id'];
            $favori = json_decode($user['favori']);
        }
        $els = [
            ["Feu","🔥"],
            ["Foudre","⚡"],
            ["Glace","❄"],
            ["Eau","💧"],
            ["Dragon","🐉"]
        ];
        $monstre = $monstreObj->getOne($_GET['id']);        
        if (isset($_GET['heart']) && $_GET['heart'] === "true") {
            $favori[] = $_GET['id'];
            $favori = json_encode($favori);
            $userObj->updateFavori($user_id, $favori);
        }
        if (isset($_GET['heart']) && $_GET['heart'] === "false"){
            $index = array_search($id,$favori);
            array_splice($favori,$index,1);
            $favori = json_encode($favori);
            $userObj->updateFavori($user_id, $favori);
        }
        
        if(isset($_POST['commentaire']) && !empty($_POST['commentaire'])){
            $commentaireToEdit = htmlentities(strip_tags($_POST['commentaire']));
            $commentaire_id = $_GET['commentaire_id'];
            $commentaireObj->update($commentaire_id, $commentaireToEdit);
            header('Location: ?page=monstredetails&id='.$id);
        }
        
        if (isset($_POST['message']) && !empty($_POST['message'])) {
            $message = htmlentities(strip_tags($_POST['message']));
            $commentaireObj->add($message, $_SESSION['user']['id'], $id);
        }
        $commentaires = $commentaireObj->getAllByMonstre($_GET['id']);
        $template = './views/template_monstre_details.phtml';
        $this->render($template, ['monstre' => $monstre, 'commentaires' => $commentaires, 'els' => $els, 'favori' => $favori, 'id' => $id]);        
    }

    public function render($templatePath, $data){
        ob_start();
        include $templatePath;

        $template = ob_get_clean();
        include './views/base.phtml';
    }
}