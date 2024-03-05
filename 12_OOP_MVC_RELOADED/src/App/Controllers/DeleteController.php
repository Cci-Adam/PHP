<?php
namespace App\Controllers;
use App\Services\Utils;
use App\Models\CommentaireManager;
use App\Models\MonstreManager;
use App\Models\MonstreDetailsManager;
use App\Models\UserManager;
use App\Models\UserDetailsManager;

class DeleteController
{
    public function index()
    {
        $utilsObj = new Utils();
        $utilsObj->verifAdmin();
        $tab = $_GET['tab'];
        $id = $_GET['id'];
        if ($tab == 'monstre') {
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
            header('Location: ?page=adminmonstretab');
        }
        else if ($tab == 'user') {
            $commentaireObj = new CommentaireManager();
            $commentaireObj->delete(null, "DELETE FROM commentaire WHERE user_id = $id");
            $userDetailsObj = new UserDetailsManager();
            $userDetailsObj->delete(null, "DELETE FROM user_details WHERE user_id = $id");
            $userObj = new UserManager();
            $user = $userObj->getOneById($id);
            $pathToDelete = $user['avatar'];
            if ($pathToDelete != './assets/avatars/default.jpg') {
                unlink($pathToDelete);
            }
            $userObj->delete($id);
            var_dump($user);
            header('Location: ?page=adminusertab');
        }
        else if(isset($_GET['commentaire_id']) && $tab == 'commentaire')
        {
            $commentaire_id = $_GET['commentaire_id'];
            $commentaireObj = new CommentaireManager();
            $commentaireObj->delete($commentaire_id);
            header('Location: ?page=monstredetails&id='.$_GET['id']);
        }
    }
}