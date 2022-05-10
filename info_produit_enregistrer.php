<?php
include_once("auth/auth.php");
require("fonction.php");

include("header.php");

?>


<?php

                                $id=$_GET['id'];
                                $reponse=$bdd->query("SELECT * from produit where idProduit='$id' ");
                                $donnees=$reponse->fetch();

               
                              ?>


<div class="container-fluid">
    
    <div class="headtext px-5">
        <h2 class="ui left floated header">MyDoctorHome <small>la médécine à la maison</small></h2>
        <div class="ui clearing divider"></div>
    </div>
<br><br>
<div class="container-fluid">


<div class="span2">

    
<img src="membres/image/<?php echo $donnees['image_Pro']; ?>"  class="img-rounded" width="200" /> <br/><br/>
  
  <div >
    

   </div></div>      
<div class="span6 offset1">
   


<div class="container-fluid">
          <div class="page-header">
            <h2><strong></i> <?= e($donnees['Nom_Pro']) ?></strong><br/><br/></h2>
             <strong><?= e($donnees['Description_Pro']) ?></strong><br/><br/>
             <?php   
                  if($donnees['Qte_Pro']>0){
             ?>
             <strong><?= e('Stock disponible:  '.$donnees['Qte_Pro']) ?></strong><br/><br/>

          <?php 
              }else
              {
                echo '<b>stock épuisé</b>';
              }

             ?>
          </div>
            
            <div class="span6">
                <ul class="nav nav" id="myTab">
                    <li class="active"><a href="#description"> Description</a></li>
                    <li><a href="#utilisation">Utilisation</a></li>
                    <li><a href="#composition">Composition</a></li>
                </ul>
                
                <div class="tab-content">
                    <div class="tab-pane active" id="description">

                      <?php

                                $id=$_GET['id'];
                                $reponse=$bdd->query("SELECT * from produit where idProduit='$id' ");
                                $donnees=$reponse->fetch();

               
                              ?><br><br>
                      
<strong><i class="icon icon-tag"></i> <?= e('Titre:  '.$donnees['Nom_Pro']) ?></strong><br/><br/>
    <strong><i class="icon icon-info-sign"></i> <?= e('Description:  '.$donnees['Description_Pro']) ?></strong><br/><br/>
     <strong><i class="icon icon-"></i> <?= e('Prix:  '.$donnees['Prix_Pro'].' £ ') ?></strong><br/><br/>

        <?php 


    try
{
  /*  connexion a la base de donnée   */


  $bdd= new PDO('mysql:host=localhost;dbname=mydoctorhome','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}catch(Exception $e)
{
  die('Erreur :' .$e->getMessage());
}

$reponse=$bdd->prepare("SELECT * from Abonne where idAbonne=?");
$reponse->execute(array($donnees['idAbonne']));
$reponse=$reponse->fetch();

?>
        <b>Publié par:</b> <a href="mailto:<?= e($reponse['Email']) ?>">

 <?php
echo $reponse['Nom'].'  '.$reponse['Prenom'];

  ?></a>




                    </div>
                    <div class="tab-pane" id="utilisation"><br><br>
                     
<strong><?= e('Utilisation du produit :  '.$donnees['Utilisation_Pro']) ?></strong><br/><br/>
   


                    </div>
                    <div class="tab-pane" id="composition"><br><br>
                        
 <strong><?= e('Composition du produit:  '.$donnees['Composition_Pro']) ?></strong><br/><br/>

                    </div>
                </div>
            </div>
            
        </div>


<script src="js/jquery-latest.js"></script>
<script src="js/bootstrap.min.js"></script>

<script>
  $('#myTab a').click(function (e) {
    e.preventDefault();
    $(this).tab('show');
    })
</script>



</div>
</div>
</div></div></div> 




<br><br><br>



<?php

include("pied.php");
?>