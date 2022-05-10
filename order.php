<?php 
include_once("auth/auth.php");
require("fonction.php");
include("header.php");

 ?>

 <div class="container-fluid">
    
        <div class="page-header">
        	<h2 style="color:green">MyDoctorHome <small>la médécine à la maison</small></h2>
        </div>


<?php

try
{
  $bdd= new PDO('mysql:host=localhost;dbname=mydoctorhome','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}catch(Exception $e)
{
  die('Erreur :' .$e->getMessage());
}



$requete=$bdd->prepare('SELECT * from achat where client=? order by date_achat desc');

 $user=$bdd->prepare("SELECT id from utilisateurs where mail=? ");
                      $user->execute(array($_SESSION['mail']));
                       $user=$user->fetch();    

$requete->execute(array($user['id']));

while($donnees=$requete->fetch()) { ?>
 
<div class="span2 offset0">

<img src="membres/image/<?php echo $donnees['image']; ?>"  width="100"  class="img-rounded" /><br/><br/>
<a href="suppression_order.php?id=<?php echo $donnees['id']; ?>"> <button type="submit" class="btn btn-danger" name="suprimer_produit"> <i class="icon-white icon-trash"></i> suprimer</button></a>


  <!--  <a href="suppression.php?id=<?php echo $donnees['id']; ?>"> <button type="submit" class="btn btn-danger" name="suprimer_produit"> <i class="icon-white icon-trash"></i> suprimer</button></a> -->


  
  </div ><br/><br/>
  

<div class="span6 offset0">

          <div class="page-header">

            
            <h5><strong></i> <?= e($donnees['titre_produit']) ?></strong></h5>
             <strong><?= e('Prix unitaire : '.$donnees['prix_produit'].' Euros') ?></strong><br/>
             <strong><?= e('Achat effectué : '.$donnees['date_achat']) ?></strong><br/>
             <?php  $user=$bdd->prepare("SELECT * from utilisateurs where mail=? ");
                      $user->execute(array($donnees['email_user']));
                       $user=$user->fetch();    
 ?>


               <strong><?= e('Produit publié par : '.$user['prenom'].'  '.$user['nom']) ?></strong><br/>
         
 </div>
 </div><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
<?php

        }

         $requete->closeCursor();


?>






        </div>


       <?php include("pied.php"); ?>

   </body>
    </html>