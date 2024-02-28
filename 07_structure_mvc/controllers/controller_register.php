<?php
$success=false;

if(isset($_POST['email']) && isset($_POST['password']) && !empty($_POST['email']) && !empty($_POST['password'] && $_POST['password'] === $_POST['confirmPassword'])){
    $errors=[];
    $extension = getExtension($_FILES['avatar']['name']);
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
    if(!extensionAutorisee($extension)){
        $errors[] = "Extension non autorisee";
    }

    $db = connectDB();
    $query = $db->prepare("SELECT * FROM user WHERE email = :email OR username = :username");
    $query->bindParam(':username', $username);
    $query->bindParam(':email', $email);
    $query->execute();
    $exists = $query->fetchColumn();

    if($exists) {
        $errors[] = "Cet user existe déjà";
    }
    
    if(empty($errors)){
        $sql=$db->prepare("INSERT INTO user (email, password, username, avatar) VALUES (:email, :password, :username, :avatar)");
        $sql->bindParam(':avatar', $newFile);
        $sql->bindParam(':username', $username);
        $sql->bindParam(':email', $email);
        $sql->bindParam(':password', $password);
        $sql->execute();
        move_uploaded_file($_FILES['avatar']['tmp_name'], $newFile);
        $sql=$db->prepare("INSERT INTO user_details (user_id, firstname, lastname, address1, address2, zip, city, state)
        VALUES (:user_id, :firstname, :lastname, :address1, :address2, :zip, :city, :state)");
        $user_Id = $db->lastInsertId();
        $sql->bindParam(':user_id', $user_Id);
        $sql->bindParam(':firstname', $firstname);
        $sql->bindParam(':lastname', $lastname);
        $sql->bindParam(':address1', $address1);
        $sql->bindParam(':address2', $address2);
        $sql->bindParam(':zip', $zip);
        $sql->bindParam(':city', $city);
        $sql->bindParam(':state', $state);
        $sql->execute();
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