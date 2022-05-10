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

 $reponse=$bdd->prepare('SELECT idAbonne,Nom,Prenom,Email,Avatar from Abonne where idAbonne=? ');
$reponse->execute(array($donnees['idAbonne']));
$user=$reponse->fetch();


if (isset($_GET['id']) AND !empty($_GET['id'])) { ?>

<div style="background:green;height:100px;width: 829px">
 <p class="offset-1"><a style="color: white" href="info_user.php?id=<?php echo $user['idAbonne']; ?>"><img src="membres/avatar/<?php echo $user['Email']; ?>"  width="40"  style="border-radius: 100%" /> <?= $user['Prenom']." ".$user['Nom']?></a>

 </p>

</div>


<div class="jumbotron"">
<?php
 if(!is_null($donnees['Description_Pub'] )){
echo '<h5 class="offset-1">'.$donnees['Description_Pub'].'<br><br></h5><hr>';
echo '<b class="offset-1" style="color:green">'.$donnees['Date_Pub'].'<br><br></b>';
}
 ?>

<?php
  if(!is_null($donnees['Image'] )){
  ?>
  <div class="offset-4">
<img src="membres/pub_image/<?php echo $donnees['Titre_Pub']; ?>"  width="180"/>

</div><hr>
<?php
echo '<b class="offset-1" style="color:green">'.$donnees['Date_Pub'].'<br><br></b>';
}
		}

  ?>
<h5>Cette publications à été aimé par : </h5>

<?php
$message=$bdd->prepare("SELECT * from Publication where idPublication=?  order by Date_Pub desc");
$message->execute(array($donnees['idPublication']));
$publications=$message->fetch();

$likes=$bdd->prepare('SELECT * from like_pub where idPublication=?');
$likes->execute(array($publications['idPublication']));
$likes=$likes->rowCount();

$likes_name=$bdd->prepare('SELECT * from like_pub where idPublication=?');
$likes_name->execute(array($publications['idPublication']));
/*$likes_name=$likes_name->fetch();*/

?>

           

<?php
while ($name=$likes_name->fetch()) {
 
  $user_like=$bdd->prepare('SELECT * from Abonne where idAbonne=?');
$user_like->execute(array($name['idAbonne']));
$user_like=$user_like->fetch();

$amitie=$bdd->prepare("SELECT * from Abonne where idAbonne=?");
$amitie->execute(array($user_like['idAbonne']));
$amitie=$amitie->fetch();  ?>

 <a href="info_user.php?id=<?= $amitie['idAbonne'] ?>"> <?= '<br><p style="color:blue">'.$user_like['Prenom'].' '.$user_like['Nom'].'</p>'; ?> </a>

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