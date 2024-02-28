<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma Premiere page PHP</title>
</head>
<body style="font-size: 30px;">
    <h1>Ma Premiere page PHP</h1>
    <?php $date = "29 Janvier 2024";
    $total = 50+15;
    $rate = 0.055;
    $tva = $total*$rate;
    echo "$<pre>";
    class Voiture{
        public $couleur = "blanc";
        public $energy = "gas";
        public function start(){
            echo "ERROR ERROR !!!";
        }
    }
    $twingo = new Voiture();
    $tesla = new Voiture();
    $tesla->energy = "electric";
    $tesla->start();
    for ($i = 1; $i <= 1000; $i++) {
        $tesla->start();
        if ($i % 10 == 0) {
            echo "<br>";
        }
    }
    $array=array(1,2,3,4,5,6,7,8,9,10);
    var_dump($array);
    var_dump($total);
    echo "Le montant total est de : " . $total . "€ <br> Le montant de la TVA est de : " . $tva . "€";
    echo "<br>";
    echo $date;
    phpinfo();
    ?>
</body>
</html>