<?php
verifAdmin();
$id = $_GET['id'];
$db = connectDB();
$tab = $_GET['tab'];
if ($tab == 'monstre') {
    // On va supprimer l'image
    $sql = $db->prepare("SELECT * FROM monstre WHERE id = :id");
    $sql->bindParam(':id', $id);
    $sql->execute();
    $result = $sql->fetch();
    $pathToDelete = $result['img'];
    if ($pathToDelete != './assets/mh_img/addMonster.jpg') {
    unlink($pathToDelete);
    }
    // Suppression des commentaires, details et du monstre
    $query = $db->prepare("DELETE FROM commentaire WHERE monstre_id = :id");
    $query->bindParam(':id', $id);
    $query->execute();
    $query = $db->prepare("DELETE FROM monstre_details WHERE id = :id");
    $query->bindParam(':id', $id);
    $query->execute();
    $query = $db->prepare("DELETE FROM monstre WHERE id = :id");
    $query->bindParam(':id', $id);
    $query->execute();
    
    header('Location: ?page=admin_monstre_tab');
}
else if ($tab == 'user') {
    $query = $db->prepare("DELETE FROM user_details WHERE user_id = :id");
    $query->bindParam(':id', $id);
    $query->execute();
    $query = $db->prepare("DELETE FROM user WHERE id = :id");
    $query->bindParam(':id', $id);
    $query->execute();
    header('Location: ?page=admin_users_tab');
}
else if(isset($_GET['commentaire_id']) && $tab == 'commentaire')
{
    $commentaire_id = $_GET['commentaire_id'];
    var_dump($commentaire_id);
    $query = $db->prepare("DELETE FROM commentaire WHERE id = :id");
    $query->bindParam(':id', $commentaire_id);
    $query->execute();
    header('Location: ?page=monstre_detail&id='.$_GET['id']);
}
?>