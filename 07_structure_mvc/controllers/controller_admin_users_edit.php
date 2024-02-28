<?php 
verifAdmin();

$id = $_GET['id'];
$db = connectDB();
$query = $db->prepare("SELECT * FROM user left join user_details on user.id = user_id WHERE user.id = :id");
$query->bindParam(':id', $id);
$query->execute();
$user = $query->fetch(PDO::FETCH_ASSOC);
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
        $sql=$db->prepare("UPDATE user SET email = :email, roles = :roles, username = :username WHERE id = :id");
        $sql->bindParam(':id', $id);
        $sql->bindParam(':roles', $roles);
        $sql->bindParam(':email', $email);
        $sql->bindParam(':username', $username);
        $sql->execute();
        $sql=$db->prepare("UPDATE user_details SET firstname = :firstname, lastname = :lastname, address1 = :address1, address2 = :address2,
        zip = :zip, city = :city, state = :state WHERE user_id = :id");
        $sql->bindParam(':id', $id);
        $sql->bindParam(':firstname', $firstname);
        $sql->bindParam(':lastname', $lastname);
        $sql->bindParam(':address1', $address1);
        $sql->bindParam(':address2', $address2);
        $sql->bindParam(':zip', $zip);
        $sql->bindParam(':city', $city);
        $sql->bindParam(':state', $state);
        $sql->execute();
        $success = true;
        header("Location: ?page=admin_users_tab");
    }
}
include "./views/base.phtml";
?>