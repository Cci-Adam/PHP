<?php 
Utils::verifAdmin();
require_once('./models/User.php');
$userObj = new User();
$id = $_GET['id'];
$db = Utils::connectDB();
$user = $userObj->getOneById($id);
$username = $user['username'];
$firstname = $user['firstname'];
$lastname = $user['lastname'];
$email = $user['email'];
$address1 = $user['address1'];
$address2 = $user['address2'];
$zip = $user['zip'];
$city = $user['city'];
$state = $user['state'];
$roles = json_decode($user['roles']);
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
    $exists = false;
    
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
    var_dump($roles);
    if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        $errors[] = "L'email n'est pas valide";
    }

    if(empty($errors)){
        $roles = json_encode($roles);
        $userObj->updateAdmin($id, $email, $username, $roles, $firstname, $lastname, $address1, $address2, $zip, $city, $state);
        $success = true;
        header("Location: ?page=admin_users_tab");
    }
}
include "./views/base.phtml";
?>