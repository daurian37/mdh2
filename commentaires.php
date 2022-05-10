
	<?php
include_once("auth/auth.php");


include("header.php");
?>

	<div class="container-fluid">

         <!-- zone de texte après la barre de ménu -->

    <div class="headtext px-5">
        <h2 class="ui left floated header">MyDoctorHome <small>la médécine à la maison</small></h2>
        <div class="ui clearing divider"></div>
    </div>
        
    <div class="row col-lg-10 offset-1 jumbotron my-5">
            <div class="col-lg-6">
                <h2>Forum</h2>
                <p>MyDoctorHome c'est aussi un réseau d'échange et de partage
facilitant ainsi l'échange entre professionnels de santé et particuliers.<br>
Grâce à son réseau et son forum, vous pouvez consulter les publications et conseils des professionnels de santé mais aussi discuter entre amis.
Echangez vos connaissances afin de changer le monde.
                </p>
            </div>
         
            <div class="col-lg-6">
                <div>
                <img src="Images/forum.jpeg" class="imgC">
                </div>
            </div>
              
    </div>
  

<div class="container-fluid">


<h2 style="color: green">Commentaires</h2>

<?php


if(isset($_GET['id']) AND !empty($_GET['id'])){

$getid=htmlspecialchars($_GET['id']);


if (isset($_POST['commenter'])) {



  if(isset($_POST['nom'],$_POST['commentaire']) AND !empty($_POST['nom']) AND !empty($_POST['commentaire']) ){


$nom=htmlspecialchars($_POST['nom']);
  $commentaire=htmlspecialchars($_POST['commentaire']);

$ins=$bdd->prepare('INSERT into commentaire_forum (idSujet,idAbonne,Commentaire,Date_Com) VALUES(?,?,?,NOW())');
$ins->execute(array($getid,$nom,$commentaire));


  }
}




$commentaires=$bdd->prepare('SELECT * from commentaire_forum where idSujet=? order by Date_Com desc');
$commentaires->execute(array($getid));




?>


<?php  

}

?>


<form method="POST">
 
 <input type="hidden"  name="nom" id="nom" placeholder="Entrer votre nom" <?php if(isset($_SESSION['id'])){echo 'value="'.$_SESSION['id'].'"'; } ?> required="required"><br>

<textarea name="commentaire" class="form-control form-control-lg" id="commentaire" placeholder="votre commentaire...." rows="3" required="required"></textarea><br>

<input type="submit" name="commenter" class="btn-primary" value="poster mon commentaire"><br><br>

</form>


<table class="table table-striped" border="2">
  <tr>
<th style="background:green;color:white">Auteur</th>
<th style="background:green;color:white">Sujet :
<?php 

  try
{
    $bdd=new PDO('mysql:host=localhost;dbname=mydoctorhome','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}catch(Exception $e)
{
    die('Erreur :' .$e->getMessage());
}

$message=$bdd->prepare('SELECT * from sujet_discution where idSujet=? order by Date_Sujet desc');
$message->execute(array($getid));
$message=$message->fetch();
echo $message['Titre_Sujet'];

?>

</th>
<th style="background:green;color:white">Date de publication</th>
<!-- <th style="color: green">Nombre de messages</th> -->
  </tr>

  <?php   


$commentaires=$bdd->prepare('SELECT * from commentaire_forum where idSujet=? order by Date_Com desc');
$commentaires->execute(array($getid));


while ($comment= $commentaires->fetch()) {  ?>
  <?php     if($comment['idSujet']){  ?>

   <tr>

<td>
  <?php

try
{
    $bdd=new PDO('mysql:host=localhost;dbname=mydoctorhome','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}catch(Exception $e)
{
    die('Erreur :' .$e->getMessage());
}

$reponse=$bdd->prepare('SELECT * from Abonne where idAbonne=? ');
$reponse->execute(array($comment['IdAbonne']));
$donnees=$reponse->fetch();
?>
 <b><?php 

if ($donnees['Nom'] == $_SESSION['nom'] AND $donnees['Prenom']==$_SESSION['prenom']) {
?>


  <a style="color:blue" href="profil.php?id=<?php echo $donnees['idAbonne']; ?>">
 
    <img src="membres/avatar/<?php echo $_SESSION['mail']; ?>"  width="40"   style="border-radius: 100%" /> <?=$_SESSION['prenom'].'  '.$_SESSION['nom']?></a>

<?php
    }else{ ?>

 <a style="color: blue" href="info_user.php?id=<?php echo $donnees['idAbonne']; ?>">
 
    <img src="membres/avatar/<?php echo $donnees['Email']; ?>"  width="40"   style="border-radius: 100%" /> <?= $donnees['Nom'].'  '.$donnees['Prenom']?></a></a>

<?php
    }
?></b>

  </td>

  <td>
   
<?= $comment['Commentaire'] ?>


  </td>

  <td width="60px">
   
<i class="icon-time"></i> <?= $comment['Date_Com'] ?>

  </td>


  </tr>

<?php
  }
}

?>

</table>


</div>

</div><br><br><br><br><br>

<!-- js -->
<script src="js/jquery-latest.js"></script>
<script src="js/bootstrap.min.js"></script>



    <?php
include("pied.php");

    ?>
</body>
</html>