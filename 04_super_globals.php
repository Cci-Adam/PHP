<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php
//Si la variable avatar arrive par FILES, on le copie dans le dossier uploads
if (isset($_FILES['avatar'])) {
    $errors = [];
    $accepted = ["image/png", "image/jpeg"];
    $array_name = explode(".", $_FILES['avatar']['name']);
    $extension = end($array_name);
    if(!in_array($_FILES['avatar']['type'], $accepted)) {
        $errors[] = "Ce fichier n'est pas une image valide";
    }
    if(empty($_POST['name']) || empty($_POST['email'])  || empty($_POST['password']) || empty($_FILES['avatar'])) {
        $errors[] = "Veuillez remplir tous les champs";
        var_dump($errors);
    }
    $newFile = "./uploads/" . time() . "." . $extension;
    if(empty($errors)) {
        move_uploaded_file($_FILES['avatar']['tmp_name'], $newFile);
    }
}

echo "<pre>";
var_dump($GLOBALS);
?>
<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
    <label for="truc">Name</label>
    <input type="text" name="name" id="name">
    <label for="email">Email</label>
    <input type="text" name="email" id="email">
    <label for="password">Password</label>
    <input type="password" name="password" id="password">
    <input type="file" name="avatar" id="">
    <input type="submit" value="envoyer">
</form>

    
</body>
</html>