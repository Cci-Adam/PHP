<?php
$id = $_GET['id'];
$db = Utils::connectDB();
require_once('./models/User.php');
require_once('./models/Monstre.php');
require_once('./models/Commentaire.php');
$monstreObj = new Monstre();
$userObj = new User();
$commentaireObj = new Commentaire();

if(Utils::isUserConnected()) {
    $user = Utils::getUser($_SESSION['user']['id']);
    $favori = json_decode($user['favori']);
}

$els = [
    ["Feu","🔥"],
    ["Foudre","⚡"],
    ["Glace","❄"],
    ["Eau","💧"],
    ["Dragon","🐉"]
];

if (isset($_GET['heart']) && $_GET['heart'] === "true") {
    $favori[] = $_GET['id'];
    $favori = json_encode($favori);
    Utils::showGlobals();
    $userObj->updateFavori($user_id, $favori);
}
if (isset($_GET['heart']) && $_GET['heart'] === "false"){
    $index = array_search($id,$favori);
    Utils::showGlobals();
    array_splice($favori,$index,1);
    $favori = json_encode($favori);
    $userObj->updateFavori($user_id, $favori);
}

if(isset($_POST['commentaire']) && !empty($_POST['commentaire'])){
    $commentaireToEdit = htmlentities(strip_tags($_POST['commentaire']));
    $commentaire_id = $_GET['commentaire_id'];
    $sql = $db->prepare("UPDATE commentaire SET commentaire = :commentaire WHERE id = :id");
    $sql->bindParam(':commentaire', $commentaireToEdit);
    $sql->bindParam(':id', $commentaire_id);
    $sql->execute();
    header('Location: ?page=monstre_detail&id='.$id);
}

if (isset($_POST['message']) && !empty($_POST['message'])) {
    $message = htmlentities(strip_tags($_POST['message']));
    $commentaireObj->add($message, $_SESSION['user']['id'], $id);
}


$monstre = $monstreObj->getOne($id);
$commentaires = $commentaireObj->getAll();
include "./views/base.phtml";
?>