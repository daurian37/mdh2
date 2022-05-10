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
 <div class="container-fluid">
        <div class="headtext px-5 py-3">
            <h2 class="ui left floated header">MyDoctorHome <small>la médécine à la maison</small></h2>
            <div class="ui clearing divider"></div>
        </div>
        
      <div class="row py-3">
        <div class="col-lg-2 offset-1 jumbotron">
          <div class="nav sidebar-nav">
            <ul class="nav flex-column">
              <li class="nav-item"><a href="amis.php" class="nav-link active"><i class="fa fa-list-alt"></i> Mes rendez vous</a></li>
              <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-comment"></i> Groupe de discussion
                                <!-- <span class="caret"> </span> -->
                            </a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-item"><a href="envoie.php"> Creer un groupe</a></li>
                                <li class="dropdown-item"><a href="amis.php">Vos groupes</a></li>
                            </ul>
                        </li>
              
              <li class="nav-item"><a href="#" class="nav-link active"><i class="fa fa-user"></i> Sponsorisé</a></li>
                <li class="nav-item"><a href="messagerie.php" class="nav-link active"><i class="fa fa-envelope"></i> Message instantanée</a></li>
            </ul>
          </div>
        </div>
          
        <!--debut modification apporté par daurian le 28 juin 2020 -->
<div class="col-lg-8 jumbotron">
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

$ins=$bdd->prepare('INSERT into Publication (Description_Pub,idAbonne,Date_Pub) values (?,?,NOW())');
$ins->execute(array($message,$id_publicateur));

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



          $req = $bdd->prepare('INSERT into Publication(Titre_Pub,Image,idAbonne,Date_pub) values(?,?,?,NOW())');
          $req -> execute(array($chaine,implode($_FILES['avatar'], ""),$id_publicateur));
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

<div class="container-fluid">


<div class="col-lg-8 offset-2">

<?php 
    
  try
{
    $bdd=new PDO('mysql:host=localhost;dbname=mydoctorhome','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}catch(Exception $e)
{
    die('Erreur :' .$e->getMessage());
}

$message=$bdd->query('SELECT * from Publication  order by Date_pub desc');

while ($publications = $message->fetch()) { ?>

<?php
  $reponse=$bdd->prepare('SELECT * from Abonne where idAbonne=? ');
$reponse->execute(array($publications['idAbonne']));
$donnees=$reponse->fetch();


$rep=$bdd->prepare('SELECT * from Abonne where idAbonne=? ');
$rep->execute(array($publications['idAbonne2']));
$partage=$rep->fetch();
?>

<div id="pg">
<div style="background:green;height:100px;width: 890px" id="$publications['idPublication']">


 <p >
<!--debut modification apporté par daurian le 28 juin 2020 -->
  <?php 
if(is_null($publications['idAbonne2'] )){ 
if ($donnees['Nom'] == $_SESSION['nom'] AND $donnees['Prenom']==$_SESSION['prenom']) {
?>


  <a style="color: white" href="profil.php?id=<?php echo $donnees['idAbonne']; ?>">
 
    <img src="membres/avatar/<?php echo $_SESSION['mail']; ?>"  width="40" style="border-radius: 100%" /> <?= $donnees['Prenom']." ".$_SESSION['nom']?></a>

<?php
    }else if($donnees['Nom'] != $_SESSION['nom'] AND $donnees['Prenom']!=$_SESSION['prenom']) { ?>

 <a style="color: white" href="info_user.php?id=<?php echo $donnees['idAbonne']; ?>">
 
    <img src="membres/avatar/<?php echo $donnees['Email']; ?>"  width="40"  style="border-radius: 100%" /> <?= $donnees['Prenom']." ".$donnees['Nom']?></a>

<?php
    }
  }

if(!is_null($publications['idAbonne2'] )){ 
 if ($partage['Nom'] == $_SESSION['nom'] AND $partage['Prenom']==$_SESSION['prenom']) {
?>


  <a style="color: white" href="profil.php?id=<?php echo $partage['idAbonne']; ?>">
 
    <img src="membres/avatar/<?php echo $partage['Email']; ?>"  width="40"  style="border-radius: 100%" /> <?= $partage['Prenom']." ".$partage['Nom']?></a>
<?php

}else if($partage['Nom'] != $_SESSION['nom'] AND $partage['Prenom']!=$_SESSION['prenom']) { ?>

 <a style="color: white" href="info_user.php?id=<?php echo $partage['idAbonne']; ?>">
 
    <img src="membres/avatar/<?php echo $partage['Email']; ?>"  width="40"  style="border-radius: 100%" /> <?= $partage['Prenom']." ".$partage['Nom']?></a>

<?php
    }
  echo '<b style="color:white"> à partager la publication publié par '.$donnees['Prenom'].'  '.$donnees['Nom'].'</b>';
}

  ?>

 </p>


</div>

<div style="width: 890px" class="jumbotron">
<?php
if(is_null($publications['Titre_Pub'])){
echo '<h5 class="offset-1">'.$publications['Description_Pub'].'<br><br></h5>';

}

if(is_null($publications['Description_Pub']) ){
  ?>
<p class="offset-1">
 <?php

 /*$chaine=$publications['Titre_Pub'];*/

  ?>
<img  class="offset-4" src="membres/pub_image/<?php echo ($publications['Titre_Pub']); ?>"  width="180"  class="img-rounded" /> 
</p>

<?php

}
 if(!is_null($publications['Titre_Pub']) AND !is_null($publications['Description_Pub'] ) ){
  ?>
<p class="offset-1">
<?php
  echo '<p style="text-align:center">'.$publications['Titre_Pub'].'<br><br></p>';
  ?>
<img  class="offset-4" src="membres/pub_image/<?php echo ($publications['Titre_Pub']); ?>"  width="180"  class="img-rounded" /> 
</p>

<?php
}

/*echo '<b style="color:green">'.$publications['date_publication'].'</b>';*/

$nombre=$bdd->prepare('SELECT count(*) from commentaire_reseau where idPublication=?');
$nombre->execute(array($publications['idPublication']));
$nombre=$nombre->fetch();

?>

     <div class="offset-1"><b>
      

<?php

$likes=$bdd->prepare('SELECT * from like_pub where idPublication=?');
$likes->execute(array($publications['idPublication']));
$likes=$likes->rowCount();

$likes_name=$bdd->prepare('SELECT * from like_pub where idPublication=?');
$likes_name->execute(array($publications['idPublication']));
/*$likes_name=$likes_name->fetch();*/


?>

<div class="p-0 mr-3   mt-3">
    
    
            <nav class="offset-9">
                <ul class="nav nav  ">
                   
                   <li> <a href="list_jaime.php?id=<?= $publications['idPublication'] ?>"><button type="submit"class="btn btn-primary btn-default px-5"> <i class="fa fa-thumbs-up"></i> <?= $likes ?></button></a></li>


                </ul>
            </nav>



</div>

<div class="p-0 mr-3   mt-3">
    
    
            <nav class="offset-9">
                <ul class="nav nav  ">
                   
                   <li> <a href="commentaire_acceuil.php?id=<?= $publications['idPublication'] ?>"><button type="submit"class="btn btn-success btn-default px-5"> <i class="fa fa-comment"></i> <?= $nombre['count(*)']  ?></button></a></li>

                </ul>
            </nav>



</div>



    </b></div>
<hr>
    <br>
       <div class="offset-1"> 


       <a href="action.php?t=1&id=<?= $publications['idPublication'] ?> #$publications['idPublication']"> <button class="btn-primary" title="aimer" ><i class="fa fa-thumbs-up"></i> J'aime </button></a>
      <!--  <a href="action.php?t=2&id=<?= $publications['id'] ?> #$publications['id']"> <button class="btn-primary" title="aimer" ><i class="fa fa-thumbs-down"></i> J'aime pas (<?= $dislikes ?>)</button></a> -->

        <a href="commentaire_acceuil.php?id=<?= $publications['idPublication'] ?>"><button class="btn-success offset-3" title="commenter" ><i class="fa fa-comment"></i> Commenter</button></a> 

        <a href="partager_publication.php?id=<?= $publications['idPublication'] ?>"><button class="btn-primary offset-4" title="partager" ><i class="fa fa-share-alt"></i> Partager</button></a>

       </div>
  </div>
 </div>
        <?php
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