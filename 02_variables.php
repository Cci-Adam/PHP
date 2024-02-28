<?php
$x = 5;
const app = "Formation PHP";
function myCart() {
    global $x;
    echo "<p> Le montant de la commande, en cours de traitement est de : $x €</p>";
}

myCart();