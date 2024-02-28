<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MVC Training</title>
</head>
<body>
    <?php
        // C'est quelle page que l'utilisateur veut voir
        $getPage = isset($_GET['page']) ? $_GET['page'] : 'home';
        require('./controllers/controller_'.$getPage.'.php');
        include('./views/template_'.$getPage.'.phtml');
    ?>
</body>
</html>