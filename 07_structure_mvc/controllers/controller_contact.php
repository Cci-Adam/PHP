<?php
$success=false;
if(isset($_POST['sujet']) && isset($_POST['message']) && !empty($_POST['sujet']) && !empty($_POST['message'])){
    $errors=[];
    
    $db = Utils::connectDB();
    $sujet = htmlentities(strip_tags($_POST['sujet']));
    $message = htmlentities(strip_tags($_POST['message']));
    if (!Utils::isUserConnected()) {
        $errors[] = "Veuillez vous connecter";
    }
    if(empty($errors)){
        $user_Id = $_SESSION['user']['id'];
        $sql=$db->prepare("INSERT INTO contact (user_id, sujet, message) VALUES (:user_id, :sujet, :message)");
        $sql->bindParam(':user_id', $user_Id);
        $sql->bindParam(':sujet', $sujet);
        $sql->bindParam(':message', $message);
        $sql->execute();
        $success = true;
    }
}
include "./views/base.phtml";
?>