<?php
namespace App\Controllers;
use App\Models\UserManager;
use App\Models\UserDetailsManager;
use App\Services\Utils;
use App\Controllers\Controller;

class RegisterController extends Controller
{
    public function index()
    {
        $template = './views/template_register.phtml';
        $userObj = new UserManager();
        $utilsObj = new Utils();
        $success = false;
        $errors = [];
        $state = [
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
            
        if(isset($_POST['email']) && isset($_POST['password']) && !empty($_POST['email']) && !empty($_POST['password'] && $_POST['password'] === $_POST['confirmPassword'])){
            $extension = $utilsObj->getExtension($_FILES['avatar']['name']);
            $newFile = "./assets/avatars/".time().$extension;

            $email = htmlentities(strip_tags($_POST['email']));
            $username = htmlentities(strip_tags($_POST['username']));
            $password = htmlentities(strip_tags($_POST['password']));
            $password = password_hash($password, PASSWORD_DEFAULT);
            $exists = false;
            
            $firstname = htmlentities(strip_tags($_POST['firstname']));
            $lastname = htmlentities(strip_tags($_POST['lastname']));
            $address1 = htmlentities(strip_tags($_POST['address1']));
            $address2 = htmlentities(strip_tags($_POST['address2']));
            $zip = htmlentities(strip_tags($_POST['zip']));
            $city = htmlentities(strip_tags($_POST['city']));
            $state = htmlentities(strip_tags($_POST['state']));
            
            if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                $errors[] = "L'email n'est pas valide";
            }
            if(!Utils::extensionAutorisee($extension)){
                $errors[] = "Extension non autorisee";
            }
            $exists = $userObj->getOneById(null,"SELECT * FROM user WHERE email = '$email' or username = '$username'");
            if($exists) {
                $errors[] = "Cet user existe déjà";
            }
            move_uploaded_file($_FILES['avatar']['tmp_name'], $newFile);
            if(empty($errors)){
                $userObj = new UserManager();
                $ajout = $userObj->insert([$username, $email, $password, $newFile]);

                $user_Id = $ajout->lastInsertId();


                $userDetailsObj = new UserDetailsManager();
                $userDetailsObj->insert([$user_Id,$firstname, $lastname, $address1, $address2, $zip, $city, $state]);
                $success = true;
            }
        }
        $this->render($template, ['errors' => $errors, 'state' => $state, 'success' => $success]);
    }
}