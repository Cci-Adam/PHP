<?php session_start();
    $main = ["✊", "✋", "✌"];
    $insulte = [" espèce de gros mauvais !!!!", "sale noob", "retourne à l'école", "t'es pas beau"," imagine se faire battre par une IA", "t'es un noob","GG EZ"
    ,"clair manque de skill","lol","dans tes dents", "MMMDDDDRRR", "t'es nul !", "DECHET"];
    function jouer($joueur){
        if ($joueur <5) {
        
            $ordi = ($joueur+1)%3;
            global $insulte;
            global $main;	
            echo "Joueur joue : " . $main[$joueur] . "<br>";
            echo "Ordinateur joue : " . $main[$ordi] . "<br>";
            if($joueur == $ordi){
                echo "Egalite";
                $_SESSION["Egalite"]++;
            }
            elseif(($joueur+2)%3 == $ordi){
                echo "Le joueur gagne";
                $_SESSION["VicJoueur"]++;
            }
            else{
                echo "L'ordinateur gagne, " . $insulte[array_rand($insulte)] . ".";
                $_SESSION["VicOrdi"]++;
            }
        }
        else {
            $_SESSION["VicOrdi"] = 0;
            $_SESSION["VicJoueur"] = 0;
            $_SESSION["Egalite"] = 0;
        }
    }
    $🍁 = "lol";
    echo $🍁;
    jouer($_POST['joueur']);
    echo "<br> victoire ordi : " . $_SESSION["VicOrdi"];
    echo "<br> victoire joueur : " . $_SESSION["VicJoueur"];
    echo "<br> Egalite : " . $_SESSION["Egalite"];
    
?>

<form method="POST">
    <select name="joueur">
        <option value="0">Pierre</option>
        <option value="1">Feuille</option>
        <option value="2">Ciseaux</option>
        <option value="20">Reset</option>
    </select>
    <input type="submit" value="Confirmer">
</form>