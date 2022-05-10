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
                                $reponse=$bdd->query("SELECT * from publication_acceuil where id='$id' ");
                                $donnees=$reponse->fetch();

 $reponse=$bdd->prepare('SELECT id,nom,prenom,mail,avatar from utilisateurs where prenom=? ');
$reponse->execute(array($donnees['nom_publicateur']));
$user=$reponse->fetch();


if (isset($_GET['id']) AND !empty($_GET['id'])) { ?>

<div style="background:green;height:100px;width: 829px">
 <p class="offset-1"><a style="color: white" href="info_user.php?id=<?php echo $user['id']; ?>"><img src="membres/avatar/<?php echo $user['mail']; ?>"  width="40"  style="border-radius: 100%" /> <?= $donnees['nom_publicateur']." ".$user['nom']?></a>

 </p>

</div>


<div class="jumbotron"">
<?php
echo '<h5 class="offset-1">'.$donnees['message'].'<br><br></h5><hr>';
echo '<b class="offset-1" style="color:green">'.$donnees['date_publication'].'<br><br></b>';
 ?>

<?php
  if(!is_null($donnees['image'] )){
  ?>
  <div class="offset-1">
<img src="membres/pub_image/<?php echo $donnees['titre']; ?>"  width="180"/>

</div>
<?php
}
		}

  ?>
<h5>Cette publications à été commenté par : </h5>

<?php
$message=$bdd->prepare("SELECT * from commentaires_acceuil where id=?  order by date_publication desc");
$message->execute(array($donnees['id']));
$publications=$message->fetch();

$likes=$bdd->prepare('SELECT id from likes where id_message=?');
$likes->execute(array($publications['id']));
$likes=$likes->rowCount();

$likes_name=$bdd->prepare('SELECT * from likes where id_message=?');
$likes_name->execute(array($publications['id']));
/*$likes_name=$likes_name->fetch();*/

$dislikes=$bdd->prepare('SELECT id from dislikes where id_message=?');
$dislikes->execute(array($publications['id']));
$dislikes=$dislikes->rowCount();

?>

           

<?php
while ($name=$likes_name->fetch()) {
 
  $user_like=$bdd->prepare('SELECT * from utilisateurs where id=?');
$user_like->execute(array($name['id_membre']));
$user_like=$user_like->fetch();

$amitie=$bdd->prepare("SELECT * from utilisateurs where id=?");
$amitie->execute(array($user_like['id']));
$amitie=$amitie->fetch();  ?>

 <a href="info_user.php?id=<?= $amitie['id'] ?>"><?= '<br><p style="color:blue">'.$user_like['nom'].' '.$user_like['prenom'].'</p>'; ?> </a>

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