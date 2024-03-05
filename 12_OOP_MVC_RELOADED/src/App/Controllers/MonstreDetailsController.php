<?php
namespace App\Controllers;
use App\Models\MonstreManager;
use App\Models\UserManager;
use App\Models\CommentaireManager;
use App\Services\Utils;
use App\Controllers\Controller;

class MonstreDetailsController extends Controller{
    
    public function index(){
        $monstreObj = new MonstreManager();
        $userObj = new UserManager();
        $commentaireObj = new CommentaireManager();
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
        $monstre = $monstreObj->getOneById(null,"SELECT *,monstre.id as id,monstre_details.id as monstre_details_id FROM monstre JOIN monstre_details on monstre.id = monstre_id WHERE monstre.id = $id");
        if (isset($_GET['heart']) && $_GET['heart'] === "true") {
            $favori[] = $_GET['id'];
            $favori = json_encode($favori);
            $userObj->update("UPDATE user SET favori = '$favori' WHERE id = '$user_id'");
        }
        if (isset($_GET['heart']) && $_GET['heart'] === "false"){
            $index = array_search($id,$favori);
            array_splice($favori,$index,1);
            $favori = json_encode($favori);
            $userObj->update("UPDATE user SET favori = '$favori' WHERE id = '$user_id'");
        }
        
        if(isset($_POST['commentaire']) && !empty($_POST['commentaire'])){
            $commentaireToEdit = htmlentities(strip_tags($_POST['commentaire']));
            $commentaire_id = $_GET['commentaire_id'];
            $commentaireObj->update("UPDATE commentaire SET commentaire = '$commentaireToEdit' WHERE id = $commentaire_id");
            header('Location: ?page=monstredetails&id='.$id);
        }
        
        if (isset($_POST['message']) && !empty($_POST['message'])) {
            $message = htmlentities(strip_tags($_POST['message']));
            $commentaireObj = new CommentaireManager();
            $commentaireObj->insert([$_SESSION['user']['id'],$id, $message]);
        }
        $commentaires = $commentaireObj->getAll(null, "SELECT *,commentaire.id as id,user.id as user_id FROM commentaire join user on user.id = commentaire.user_id WHERE monstre_id = $id ORDER BY posted_at DESC");
        $template = './views/template_monstre_details.phtml';
        $this->render($template, ['monstre' => $monstre, 'commentaires' => $commentaires, 'els' => $els, 'favori' => $favori, 'id' => $id]);        
    }
}