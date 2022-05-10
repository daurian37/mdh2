<?php

include_once("auth/auth.php");

require("fonction.php"); 
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
    
<div class="container-fluid">


      
<div class="col-lg-8 offset-2">

<?php

try
{
    $bdd= new PDO('mysql:host=localhost;dbname=mydoctorhome','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}catch(Exception $e)
{
    die('Erreur :' .$e->getMessage());
}


                                $id=$_GET['id'];
                                $reponse=$bdd->query("SELECT * from Publication where idPublication='$id' ");
                                $donnees=$reponse->fetch();

 $reponse=$bdd->prepare('SELECT * from Abonne where idAbonne=? ');
$reponse->execute(array($donnees['idAbonne']));
$user=$reponse->fetch();

$reponse=$bdd->prepare('SELECT * from Abonne where idAbonne=? ');
$reponse->execute(array($donnees['idAbonne2']));
$partage=$reponse->fetch();


if (isset($_GET['id']) AND !empty($_GET['id'])) { ?>

<div style="background:green;height:100px;width: 828px">
 <p class="offset-1"><?php

 if (is_null($donnees['idAbonne2'])) {
  
 
if ($user['Nom'] == $_SESSION['nom'] AND $user['Prenom']==$_SESSION['prenom']) {
?>


  <a style="color: white" href="profil.php?id=<?php echo $user['idAbonne']; ?>">
 
    <img src="membres/avatar/<?php echo $user['Email']; ?>"  width="40"  style="border-radius: 100%" /> <?= $user['Prenom']." ".$user['Nom']?></a>
<?php

}else { ?>

 <a style="color: white" href="info_user.php?id=<?php echo $user['idAbonne']; ?>">
 
    <img src="membres/avatar/<?php echo $user['Email']; ?>"  width="40"  style="border-radius: 100%" /> <?= $user['Prenom']." ".$user['Nom']?></a>

<?php
}
    }else{


if ($partage['Nom'] == $_SESSION['nom'] AND $partage['Prenom']==$_SESSION['prenom']) {
?>


  <a style="color: white" href="profil.php?id=<?php echo $user['idAbonne']; ?>">
 
    <img src="membres/avatar/<?php echo $user['Email']; ?>"  width="40"  style="border-radius: 100%" /> <?= $partage['Prenom']." ".$partage['Nom']?></a>
<?php

}else { ?>

 <a style="color: white" href="info_user.php?id=<?php echo $user['idAbonne']; ?>">
 
    <img src="membres/avatar/<?php echo $user['Email']; ?>"  width="40"  style="border-radius: 100%" /> <?= $partage['Prenom']." ".$partage['Nom']?></a>
<?php
}

    }

?>

 </p>

</div>


<div class="jumbotron"">
<?php
if(!is_null($donnees['Description_Pub'] )){

echo '<h5 class="offset-1">'.$donnees['Description_Pub'].'<br><br></h5><hr>';
echo '<b class="offset-1" style="color:green">'.$donnees['Date_Pub'].'</b>';

}
 ?>

<?php
  if(!is_null($donnees['Image'] )){
  ?>
  <div class="offset-4">
<img src="membres/pub_image/<?php echo $donnees['Titre_Pub']; ?>"  width="180"/>

</div><hr>
<?php
echo '<b class="offset-1" style="color:green">'.$donnees['Date_Pub'].'</b>';
}
?>

<?php
$rep=$bdd->prepare('SELECT * from Abonne where idAbonne=? ');
$rep->execute(array($_SESSION['id']));
$rep=$rep->fetch();

?><br><br>
<?php
   if(isset($_POST['nom'],$_POST['commentaire'])){


$nom=htmlspecialchars($_POST['nom']);
$commentaire=htmlspecialchars($_POST['commentaire']);

$ins=$bdd->prepare('INSERT into commentaire_reseau (idAbonne,idPublication,Commentaire_Reseaucol,Date_Com_Reseau) VALUES(?,?,?,NOW())');
$ins->execute(array($nom,$donnees['idPublication'],$commentaire));

echo '<div class="alert alert-success" role="alert">
 Votre commentaire à bien été posté!
</div>
';
}

?>
<div class="offset-0">
  <form method="POST">
   <img src="membres/avatar/<?php echo $rep['Email']; ?>"  width="30"  style="border-radius: 100%" /><b style="color: green"><?= $rep['Prenom'].'  '.$rep['Nom']  ?></b>
   <input type="hidden"  name="nom" id="nom" placeholder="Entrer votre nom" value="<?= $_SESSION['id'] ?>" required="required"><br>

<div class="form-group">
  <textarea name="commentaire" id="commentaire" placeholder="votre commentaire...." rows="3" required="required" class="form-control"></textarea></div>

 <button type="submit" name="commenter" class="btn-primary">Poster un commentaire </button>

  </form></div>
  
<?php

$commentaires=$bdd->prepare('SELECT * from commentaire_reseau where idPublication=? order by idAbonne desc');
$commentaires->execute(array($donnees['idPublication'])); 

while ($comment = $commentaires->fetch()) {

 $reponse=$bdd->prepare('SELECT * from Abonne where idAbonne=? ');
$reponse->execute(array($comment['idAbonne']));
$donnees_comment=$reponse->fetch();
 ?>
 
 <div class="offset-4" style="background: #dcdcdc">
 <p style="margin-left: 5px">
<?php 

if ($donnees_comment['Nom'] == $_SESSION['nom'] AND $donnees_comment['Prenom']==$_SESSION['prenom']) {
?>


  <a style="color:blue" href="profil.php?id=<?php echo $donnees['idAbonne']; ?>">
 
    <img src="membres/avatar/<?php echo $_SESSION['mail']; ?>"  width="40"   style="border-radius: 100%" /> <?= $donnees_comment['Prenom']." ".$donnees_comment['Nom']?></a>

<?php
    }else{ ?>

 <a style="color: blue" href="info_user.php?id=<?php echo $donnees_comment['idAbonne']; ?>">
 
    <img src="membres/avatar/<?php echo $donnees_comment['Email']; ?>"  width="40"   style="border-radius: 100%" /> <?= $donnees_comment['Prenom'].'   '.$donnees_comment['Nom']?></a></a>

<?php
    }
?> </p></div>

<div class="offset-4">
<?php
echo '<p><br>'.$comment['commentaire_reseaucol'].'</p>';
echo '<b style="color:green">'.$comment['Date_Com_Reseau'].'<br><br><br></b>';?>
</div>

<?php
}

?>


<?php
  }

  ?>

</div>
</div>
</div>
</div><br>


<script src="js/jquery-latest.js"></script>
<script src="js/bootstrap.min.js"></script>

<?php include("pied.php");  ?>



 </body>
  
</html>