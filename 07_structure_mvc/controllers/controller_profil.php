<?php
require_once('./models/User.php');
$userObj = new User();
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
        if (isset($_SESSION['user']['id'])){
            $id=$_SESSION['user']['id'];
        }
        $success = false;
        $profil_id = $_GET['id'];
        $user = $userObj->getOneByID($profil_id);

    if(isset($_POST['email']) && !empty($_POST['email'])){
        $errors=[];
        $email = htmlentities(strip_tags($_POST['email']));
        $exists = false;
        $extension = Utils::getExtension($_FILES['avatar']['name']);
        $newFile = "./assets/avatars/".time().$extension;
        
        $username = htmlentities(strip_tags($_POST['username']));
        $password = htmlentities(strip_tags($_POST['password']));
        $password = password_hash($password, PASSWORD_DEFAULT);
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
    
        if(empty($errors)){
            $userObj->update($id, $email, $username, $newFile, $password, $firstname, $lastname, $address1, $address2, $zip, $city, $state);
            $pathToDelete = $_SESSION['user']['avatar'];
            unlink($pathToDelete);
            move_uploaded_file($_FILES['avatar']['tmp_name'], $newFile);
            $user = $userObj->getOneByID($id);
            $_SESSION['user'] = $user;
        }
    }



include './views/base.phtml'
?>