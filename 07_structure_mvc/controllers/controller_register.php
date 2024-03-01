<?php
$success=false;
require_once('./models/User.php');
$userObj = new User();

if(isset($_POST['email']) && isset($_POST['password']) && !empty($_POST['email']) && !empty($_POST['password'] && $_POST['password'] === $_POST['confirmPassword'])){
    $errors=[];
    $extension = Utils::getExtension($_FILES['avatar']['name']);
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

    $exists = $userObj->alreadyExists($email, $username);

    if($exists) {
        $errors[] = "Cet user existe déjà";
    }
    move_uploaded_file($_FILES['avatar']['tmp_name'], $newFile);
    if(empty($errors)){
        $ajout = $userObj->add($email, $password, $username, $newFile);
        $user_Id = $ajout->lastInsertId();
        $userObj->addDetails($firstname, $lastname, $address1, $address2, $zip, $city, $state, $user_Id);
        $success = true;
    }
}


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
include "./views/base.phtml";
?>