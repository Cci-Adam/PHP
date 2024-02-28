<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon site modulaire</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        #carousel img {
            aspect-ratio: 16/6;
        }
    </style>
</head>
<body>
    <?php require("header.php");
    ?>
    <main>
        <?php 
        $getPage = isset($_GET['page']) ? $_GET['page'] : 'home';
        $path = "pages/" .$getPage . ".php";
        $page = file_exists($path) ? $path : "pages/home.php";
        require($page); 
        ?>
    </main>
    <?php require("footer.php");
    ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>