<?php
namespace App\Controllers;
use App\Models\Commentaire;
use App\Models\Monstre;
use App\Services\Utils;
use App\Models\User;

class DeleteController
{
    public function index()
    {
        $utilsObj = new Utils();
        $utilsObj->verifAdmin();
        $tab = $_GET['tab'];
        $id = $_GET['id'];
        if ($tab == 'monstre') {
            $monstreObj = new Monstre();
            // On va supprimer l'image
            $monstre = $monstreObj->getOne($id);
            $pathToDelete = $monstre['img'];
            if ($pathToDelete != './assets/mh_img/addMonster.jpg') {
            unlink($pathToDelete);
            }
            // Suppression des commentaires, details et du monstre
            $monstreObj->delete($id);
            header('Location: ?page=adminmonstretab');
        }
        else if ($tab == 'user') {
            $userObj = new User();
            $user = $userObj->getOneByID($id);
            $pathToDelete = $user['avatar'];
            if ($pathToDelete != './assets/avatars/default.jpg') {
                unlink($pathToDelete);
            }
            $userObj->delete($id);
            header('Location: ?page=adminusertab');
        }
        else if(isset($_GET['commentaire_id']) && $tab == 'commentaire')
        {
            $commentaire_id = $_GET['commentaire_id'];
            $commentaireObj = new Commentaire();
            $commentaireObj->delete($commentaire_id);
            header('Location: ?page=monstredetails&id='.$_GET['id']);
        }
    }
}