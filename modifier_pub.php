<?php

include_once("auth/auth.php");

include('fonction.php');
include('connexion_bd.php');

if(!isset($_SESSION['id']))
{
 header('location:page_index_ferol.php');
}
?>
  <!--barre de navigation--> 
   <?php

include("header.php");
?>


<?php

                                $id=$_GET['id'];
                                $reponse=$bdd->query("SELECT * from Publication where idPublication='$id' ");
                                $donnees=$reponse->fetch();

               
                              ?>




 <div class="container-fluid">
        <div class="headtext px-5 py-3">
            <h2 class="ui left floated header">MyDoctorHome <small>la médécine à la maison</small></h2>
            <div class="ui clearing divider"></div>
        </div>
        
          
        <!--debut modification apporté par daurian le 28 juin 2020 -->
<div class="col-lg-8 jumbotron offset-2">
 <div class="offset-0">


 <form method="POST"  enctype="multipart/form-data">
 
 <div class="form-group">
 <input type="hidden"  name="id_publicateur" id="id_publicateur" placeholder="Entrer votre nom" value="<?= $_SESSION['id'] ?>" required="required">
</div>

<div class="form-group">
<!--   <img src="membres/avatar/<?php echo $_SESSION['mail']; ?>" width="35"  class="nav-link avatar" /> 
 -->  
<textarea name="message" id="message" style="text-align: center;border-radius: 50px" placeholder="Publier un statut, <?= $_SESSION['prenom'] ?>" rows="3" class="form-control form-control-lg"></textarea>
</div>

<!-- <div class="form-group">
<textarea  name="titre" id="titre" style="text-align: center" placeholder="Entrer un titre pour votre image"  class="form-control col-lg-5 offset-3"></textarea></div>
 -->

<div class="form-group">
 <input type="file" name="avatar" id = "avatar"  class="offset-4">
</div><br>
<div class="form-group">
<input  type="submit" name="commenter" class="offset-5 btn-primary" value="Publier">
</div>
</form> 

 </div> 
</div> 

</div> 




<div class="container-fluid">

<?php


if (isset($_POST['commenter'])) {

  if(isset($_POST['id_publicateur']) AND !empty($_POST['id_publicateur']) ){

$id_publicateur=htmlspecialchars($_POST['id_publicateur']);

  $message=htmlspecialchars($_POST['message']);
   
   /*$titre=htmlspecialchars($_POST['titre']);
*/
   if(!empty($_POST['message'] )){

$ins=$bdd->prepare('UPDATE Publication set Description_Pub=? where idPublication=?');
$ins->execute(array($message,$_GET['id']));


}

  }
}



?>

<!--fin modification apporté par daurian le 28 juin 2020 -->

<div class="span4 offset5">

<?php

if(isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name'])){

  
  $tailleMax = 2097152;
  $extensionsValides = array('jpg','jpeg','png');

  if($_FILES['avatar']['size']<= $tailleMax){

    $extensionsUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));

    if(in_array($extensionsUpload, $extensionsValides)){

      $chemin = "membres/pub_image/".($chaine).".".$extensionsUpload;

      $resultat = move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin);

      if($resultat){

        try
{
  $bdd= new PDO('mysql:host=localhost;dbname=mydoctorhome','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}catch(Exception $e)
{
  die('Erreur :' .$e->getMessage());
}

$reponse=$bdd->prepare('SELECT * from Abonne where idAbonne=?');
$reponse->execute(array($_SESSION['id']));
$reponse=$reponse->fetch();



          $req = $bdd->prepare('UPDATE Publication set Titre_Pub=?,Image=? where idPublication=? ');
          $req -> execute(array($chaine,implode($_FILES['avatar'], ""),$_GET['id']));
          $req->closeCursor();


            
      }
      else
      {
        $errors[]="Erreur durant l'importation de votre photo de profil";
      }

    }
    else
    {

      $errors[]="Votre photo de profil ne doit être au format jpg";
    }
}
    else
    {
      $errors[]="Votre photo de profil ne doit pas dépasser 2 Mo";
    }
  
}
    
?>
</div>
</div>


 </div>
</div>

    <!-- Le javascript
    ================================================== -->
    

<script src="js/jquery-latest.js"></script>
<script src="js/bootstrap.min.js"></script>


    <?php
include("pied.php");

    ?>    
 </body>
</html>