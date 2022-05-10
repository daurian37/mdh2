<?php 
include_once("auth/auth.php");
require("fonction.php");
include("header.php");

 ?>

 <div class="container-fluid">
    
         <div class="headtext px-5">
        <h2 class="ui left floated header">MyDoctorHome <small>la médécine à la maison</small></h2>
        <div class="ui clearing divider"></div>
    </div> 
    <br>

<?php

try
{
  $bdd= new PDO('mysql:host=localhost;dbname=mydoctorhome','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}catch(Exception $e)
{
  die('Erreur :' .$e->getMessage());
}



$requete=$bdd->prepare('SELECT * from panier where client=? order by id desc');

 $user=$bdd->prepare("SELECT idAbonne from Abonne where idAbonne=? ");
                      $user->execute(array($_SESSION['id']));
                       $user=$user->fetch();    

$requete->execute(array($user['idAbonne']));

$nombre=$bdd->prepare('SELECT count(*) from panier where client=?');
$nombre->execute(array($user['idAbonne']));
$nombre=$nombre->fetch(); 

$nombre_total=$bdd->prepare('SELECT sum(prix_produit) from panier where client=?');
$nombre_total->execute(array($user['idAbonne']));
$nombre_total=$nombre_total->fetch(); 

$quantite_total=$bdd->prepare('SELECT sum(quantite) from panier where client=?');
$quantite_total->execute(array($user['idAbonne']));
$quantite_total=$quantite_total->fetch(); ?>



<p style="color: blue">Détail de votre panier  "<?= $nombre['count(*)'] ?> article(s)" soit un total de 
<?php
$montant=$quantite_total['sum(quantite)'] * $nombre_total['sum(prix_produit)'];
echo $montant."  Euros";

?>

<?php

while($donnees=$requete->fetch()) { ?>
 
<div class="col-lg-4 offset-2">

<img src="membres/image/<?php echo $donnees['image']; ?>"  width="80"  class="img-rounded" />

<?php


  $prix_total=$donnees['quantite']*$donnees['prix_produit'];


?>


<br><br>
 
            <h2><strong></i> <?= e($donnees['titre_produit']) ?></strong></h2>
          <strong></i> <?= e('Stock du produit disponible : '.$donnees['stock']) ?></strong><br>
             <strong><?= e('Prix unitaire : '.$donnees['prix_produit'].' Euros') ?></strong><br/>
             <strong><?= e('Quantité à acheter: '.$donnees['quantite']) ?></strong><br/>
               <strong><?= e('Prix total : '.$prix_total.' Euros') ?></strong><br/>

             <?php  $user=$bdd->prepare("SELECT * from Abonne where idAbonne=? ");
                      $user->execute(array($donnees['idAbonne']));
                       $user=$user->fetch();    
 ?>
     <strong><?= e('Publié par : '.$user['Prenom'].'  '.$user['Nom']) ?></strong><br/>

  <a href="suppression.php?id=<?php echo $donnees['id']; ?>"> <button type="submit" class="btn btn-danger" name="suprimer_produit"> <i class="icon-white icon-trash"></i> suprimer</button></a>


  
  
   
</div > <br/><br/>

<?php

        }

         $requete->closeCursor();


?>
<?php
if($nombre['count(*)']>0){
?>
<button class="btn btn-success btn-large btn-block" type="button"><h3>Acheter</h3></button>
<?php
}
?>

</div>
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>

       <?php include("pied.php"); ?>

   </body>
    </html>