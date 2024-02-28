<?php
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
        $db = connectDB();
        $id=$_SESSION['user']['id'];
        $success = false;
        $profil_id = $_GET['id'];
        $sql=$db->prepare("SELECT * FROM user join user_details on user.id = user_details.id WHERE user.id = :id");
        $sql->bindParam(':id', $profil_id);
        $sql->execute();
        $user= $sql->fetch(PDO::FETCH_ASSOC);

    if(isset($_POST['email']) && !empty($_POST['email'])){
        $errors=[];
        $email = htmlentities(strip_tags($_POST['email']));
        $exists = false;
        $extension = getExtension($_FILES['avatar']['name']);
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
        if(!extensionAutorisee($extension)){
            $errors[] = "Extension non autorisee";
        }
    
        if(empty($errors)){
            $sql=$db->prepare("UPDATE user SET email = :email, username = :username, avatar = :avatar, password = :password WHERE id = :id");
            $sql->bindParam(':id', $id);
            $sql->bindParam(':password', $password);
            $sql->bindParam(':avatar', $newFile);
            $sql->bindParam(':email', $email);
            $sql->bindParam(':username', $username);
            $sql->execute();
            $pathToDelete = $_SESSION['user']['avatar'];
            if ($pathToDelete != './assets/mh_img/addMonster.jpg') {
                unlink($pathToDelete);
            }
            move_uploaded_file($_FILES['avatar']['tmp_name'], $newFile);
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
            
            $sql = $db->prepare("SELECT * FROM user join user_details on user.id = user_details.id WHERE email = :email");
            $sql->bindParam(':email', $email);
            $sql->execute();
            $user= $sql->fetch(PDO::FETCH_ASSOC);
            $_SESSION['user'] = $user;
        }
    }



include './views/base.phtml'
?>