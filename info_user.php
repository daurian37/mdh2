<?php
include_once("auth/auth.php");
require("fonction.php");

include("header.php");

?>



<?php

                                $id=$_GET['id'];
                                $reponse=$bdd->query("SELECT * from Abonne where idAbonne='$id' ");
                                $donnees=$reponse->fetch();

               
                              ?>


<div class="container-fluid">
    
     <div class="container-fluid">
        <div class="headtext px-5 py-3">
            <h2 class="ui left floated header">MyDoctorHome <small>la médécine à la maison</small></h2>
            <div class="ui clearing divider"></div>
        </div><br>
        


<div class="col-lg-4 offset-4">

	
    <h3 >Profil de <?= e($donnees['Prenom']) ?></h3>
  
  <div >
    <img src="membres/avatar/<?php echo $donnees['Email']; ?>"  width="140"  class="img-circle" /> <br/><br/>

            

    <strong><i class="icon icon-user"></i> <?= e($donnees['Nom']) ?></strong>
    <strong><?= e($donnees['Prenom']) ?></strong><br/>

<strong><?= e($donnees['Profession']) ?></strong><br/>

    <strong><i class="icon icon-calendar"></i> <?= e($donnees['Date_naissance']) ?></strong><br/>
    <strong><i class="icon icon-"></i> <?= e($donnees['Sexe']) ?></strong><br/>
    <strong><i class="icon icon-signal"></i> <?= e($donnees['Numero']) ?></strong><br/>
  <i class="icon-envelope"></i>  <a href="mailto:<?= e($_SESSION['mail']) ?>"><?= e($donnees['Email']) ?></a><br/><br/>
<!-- 
   <div class="form-group">
 <button style='color:white' class='btn-success'>  <a style='color:white' href='action_amis.php?action=add&id=<?= $_GET['id'] ?>'>Envoyer une demande</a></button>


  <button class='btn-danger'> <a style='color:white'href='action_amis.php?action=delete&id=<?= $_GET['id'] ?>'>Supprimer de ma liste d'amis</a></button>

</div>
  
  
 <div class="form-group">
 <button style='color:white' class='btn-primary offset-1'><a style='color:white' href='action_amis.php?action=accept&id=<?= $_GET['id'] ?>'>Accepté la demande</a></button> 

  <button  class='btn-danger'><a style='color:white' href='action_amis.php?action=delete&id=<?= $_GET['id'] ?>'>Refusé la demande</a></button>
</div>
 -->
 
 
 
  
</div>
</div>

</div></div><br><br><br><br>








<?php

include("pied.php");
?>