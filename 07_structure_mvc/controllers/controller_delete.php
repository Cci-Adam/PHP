<?php
Utils::verifAdmin();
$id = $_GET['id'];
$db = Utils::connectDB();
$tab = $_GET['tab'];
if ($tab == 'monstre') {
    require_once('./models/Monstre.php');
    $monstreObj = new Monstre();
    // On va supprimer l'image
    $monstre = $monstreObj->getOne($id);
    $pathToDelete = $monstre['img'];
    if ($pathToDelete != './assets/mh_img/addMonster.jpg') {
    unlink($pathToDelete);
    }
    // Suppression des commentaires, details et du monstre
    $monstreObj->delete($id);
    header('Location: ?page=admin_monstre_tab');
}
else if ($tab == 'user') {
    require_once('./models/User.php');
    $userObj = new User();
    $user = $userObj->getOneByID($id);
    $pathToDelete = $user['avatar'];
    if ($pathToDelete != './assets/avatars/default.jpg') {
        unlink($pathToDelete);
    }
    $userObj->delete($id);
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