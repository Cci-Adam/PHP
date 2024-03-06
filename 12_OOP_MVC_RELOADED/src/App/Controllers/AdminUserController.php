<?php
namespace App\Controllers;
use App\Models\UserManager;
use App\Models\UserDetailsManager;
use App\Models\CommentaireManager;
use App\Controllers\Controller;
use App\Services\Utils;


class AdminUserController extends Controller
{
    public function index()
    {
        $utilsObj = new Utils();
        $utilsObj->verifAdmin();
        $userObj = new UserManager();
        $users = $userObj->getAll(null,"SELECT *,user.id as id FROM user join user_details on user.id = user_details.user_id");
        $template = './views/template_admin_user_tab.phtml';
        $this->render($template, ['users' => $users]);
    }

    public function delete()
    {
        $id = $_GET['id'];
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
        header('Location: ?page=adminuser');
    }

    public function edit()
    {
        $utilsObj = new Utils();
        $utilsObj->verifAdmin();
        $userObj = new UserManager();
        $id = $_GET['id'];
        $user = $userObj->getOneById(null,"SELECT *,user.id as id FROM user join user_details on user.id = user_details.user_id WHERE user.id = $id");
        $errors = [];
        $state =[
            "Auvergne-Rhône-Alpes",
            "Bourgogne-Franche-Comté",
            "Bretagne",
            "Centre-Val de Loire",
            "Corse",
            "Grand Est",
            "Hauts-de-France",
            "Ile-de-France",
            "Normandie",
            "Nouvelle-Aquitaine",
            "Occitanie",
            "Pays de la Loire",
            "Provence Alpes Côte d'Azur",
            "Guadeloupe",
            "Guyane",
            "Martinique",
            "Mayotte",
            "Réunion"];
            if(isset($_POST['email']) && !empty($_POST['email'])){
                $errors=[];
                $email = htmlentities(strip_tags($_POST['email']));
                $username = htmlentities(strip_tags($_POST['username']));
                $firstname = htmlentities(strip_tags($_POST['firstname']));
                $lastname = htmlentities(strip_tags($_POST['lastname']));
                $address1 = htmlentities(strip_tags($_POST['address1']));
                $address2 = htmlentities(strip_tags($_POST['address2']));
                $zip = htmlentities(strip_tags($_POST['zip']));
                $city = htmlentities(strip_tags($_POST['city']));
                $state = htmlentities(strip_tags($_POST['state']));
                $roles = ["ROLE_MEMBER"];
                if(!empty($_POST['roles'])) {
                    foreach ($_POST['roles'] as $role) {
                        $roles[] = $role;
                    }
                }
                if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                    $errors[] = "L'email n'est pas valide";
                }
            
                if(empty($errors)){
                    $roles = json_encode($roles);
                    $userObj->update("UPDATE user SET username = '$username', email = '$email', roles = '$roles' WHERE id = '$id'");
                    $userDetailsObj = new UserDetailsManager();
                    $userDetailsObj->update("UPDATE user_details SET firstname = '$firstname', lastname = '$lastname', address1 = '$address1', address2 = '$address2', zip = '$zip', city = '$city', state = '$state' WHERE user_id = '$id'");
                    $success = true;
                    header("Location: ?page=adminuser");
                }
            }
            $template = './views/template_admin_user_edit.phtml';
            $this->render($template, ['user' => $user,'errors' => $errors,'state' => $state]);
    }
}