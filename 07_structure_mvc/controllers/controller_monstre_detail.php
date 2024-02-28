<?php
$id = $_GET['id'];
$db = connectDB();
if(isUserConnected()) {
    $user = getUser($_SESSION['user']['id']);
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
    showGlobals();
    $sql = $db->prepare("UPDATE user SET favori = :favori WHERE id = :id");
    $sql->bindParam(':id', $user_id);
    $sql->bindParam(':favori', $favori);
    $sql->execute();
}
if (isset($_GET['heart']) && $_GET['heart'] === "false"){
    $index = array_search($id,$favori);
    showGlobals();
    array_splice($favori,$index,1);
    $favori = json_encode($favori);
    $sql = $db->prepare("UPDATE user SET favori = :favori WHERE id = :id");
    $sql->bindParam(':id', $user_id);
    $sql->bindParam(':favori', $favori);
    $sql->execute();
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
    $sql = $db->prepare("INSERT INTO commentaire (commentaire, user_id, monstre_id) VALUES (:commentaire, :user_id, :monstre_id)");
    $sql->bindParam(':commentaire', $message);
    $sql->bindParam(':user_id', $_SESSION['user']['id']);
    $sql->bindParam(':monstre_id', $id);
    $sql->execute();
}
$query = $db->prepare("SELECT * FROM monstre join monstre_details on monstre_details.id = monstre.id WHERE monstre.id = :id");
$query->bindParam(':id', $id);
$query->execute();
$monstre = $query->fetch(PDO::FETCH_ASSOC);
$query = $db->prepare("SELECT *,commentaire.id as id,user.id as user_id FROM commentaire join user on user.id = commentaire.user_id WHERE monstre_id = :id ORDER BY posted_at ASC");
$query->bindParam(':id', $id);
$query->execute();
$commentaires = $query->fetchAll(PDO::FETCH_ASSOC);
include "./views/base.phtml";
?>