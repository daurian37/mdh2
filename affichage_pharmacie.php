<?php

if(isset($_POST['affichage_parmacie'])){
try
{
    $bdd=new PDO('mysql:host=localhost;dbname=mydoctorhome','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}catch(Exception $e)
{
    die('Erreur :' .$e->getMessage());
}

$reponse=$bdd->query('SELECT nom,ville from pharmacie ');


while($donnees=$reponse->fetch()){
?>

       <?php 
       header('Location:commande.php');
     echo htmlspecialchars($donnees['nom']) .'se trouve dans la commune de  '.htmlspecialchars($donnees['ville']).'<br>'; ?>
<?php
        }

   $reponse->closeCursor();
 }

require("pharmacie_proximite.php");
?>
