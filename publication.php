
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


<h2 style="color: green">Publications des membres </h2>

<?php


if(isset($_GET['id']) AND !empty($_GET['id'])){

$getid=htmlspecialchars($_GET['id']);


if (isset($_POST['commenter'])) {



  if(isset($_POST['nom_publicateur'],$_POST['categorie'],$_POST['message'],$_POST['titre']) AND !empty($_POST['nom_publicateur']) AND !empty($_POST['categorie']) AND !empty($_POST['message'])AND !empty($_POST['titre']) ){


$nom_publicateur=htmlspecialchars($_POST['nom_publicateur']);
  $categorie=htmlspecialchars($_POST['categorie']);
  $message=htmlspecialchars($_POST['message']);
   $titre=htmlspecialchars($_POST['titre']);

$ins=$bdd->prepare('INSERT into sujet_discution (idSujet,Description_Sujet,Titre_Sujet,idAbonne,idCat_Sujet,Date_Sujet) values (?,?,?,?,?,NOW())');
$ins->execute(array($categorie,$message,$titre,$nom_publicateur,$_GET['id'] ));


  }
}



?>


<?php  

}

?>



<form method="POST">
 
 <input type="hidden"  name="nom_publicateur" id="nom_publicateur" placeholder="Entrer votre nom" <?php if(isset($_SESSION['prenom'])){echo 'value="'.$_SESSION['id'].'"'; } ?> required="required"><br>

 <?php
if(isset($_GET['id']) AND !empty($_GET['id'])){

$getid=htmlspecialchars($_GET['id']);



  }

?>


 <?php 

  try
{
    $bdd=new PDO('mysql:host=localhost;dbname=mydoctorhome','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}catch(Exception $e)
{
    die('Erreur :' .$e->getMessage());
}

$message=$bdd->prepare('SELECT * from Cat_Sujet where idCat_Sujet=?');
$message->execute(array($getid));
$message=$message->fetch();


?>


 <input type="hidden"  name="categorie" id="categorie" placeholder="Entrer votre nomcategorie" <?php if(isset($message['idCat_Sujet'])){echo 'value="'.$message['idCat_Sujet'].'"'; } ?> required="required"><br>

 <textarea name="titre" id="titre" placeholder="Entrer le titre" class="form-control" required="required"></textarea><br>

<textarea name="message" id="message" placeholder="votre Publication...." class="form-control form-control-lg" rows="3" required="required"></textarea><br>

<input type="submit" name="commenter" class="btn-primary" value="Publier">

</form>

<br>



<table class="table table-striped" border="2">
  <tr>
<th style="background:green;color:white">Sujet de la catégorie
<?php 

  try
{
    $bdd=new PDO('mysql:host=localhost;dbname=mydoctorhome','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}catch(Exception $e)
{
    die('Erreur :' .$e->getMessage());
}

$message=$bdd->prepare('SELECT * from Cat_Sujet where idCat_Sujet=?');
$message->execute(array($getid));
$message=$message->fetch();

echo $message['Nom_Cat'];

?>

 </th>
<th style="background:green;color:white">Auteur du sujet</th>
<th style="background:green;color:white">Date et heure de publication</th>
<th style="background:green;color:white">Commentaires</th>
<!-- <th style="background:green;color:white">Partager</th> --> 
  </tr>

  <?php 

  try
{
    $bdd=new PDO('mysql:host=localhost;dbname=mydoctorhome','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}catch(Exception $e)
{
    die('Erreur :' .$e->getMessage());
}

$message=$bdd->prepare('SELECT * from sujet_discution where idCat_Sujet=? order by Date_Sujet desc');
$message->execute(array($getid));



while ($publications = $message->fetch()) { ?>

   <tr>

<td>
 <b><?= 'Titre :'.$publications['Titre_Sujet'] ?></b><br><br>
<a href="Commentaires.php?id=<?= $publications['idCat_Sujet']  ?>"><?= $publications['Description_Sujet'] ?></a>
</td>

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
$reponse->execute(array($publications['idAbonne']));
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
 
    <img src="membres/avatar/<?php echo $donnees['Email']; ?>"  width="40"   style="border-radius: 100%" /> <?= $donnees['Prenom'].'  '.$donnees['Nom']?></a></a>

<?php
    }
?></b>

</td>

<td>

</td>

<td>

 <?php

try
{
    $bdd=new PDO('mysql:host=localhost;dbname=mydoctorhome','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}catch(Exception $e)
{
    die('Erreur :' .$e->getMessage());
}
  $nombre=$bdd->prepare('SELECT count(*) from commentaire_forum where idSujet=? ');

$nombre->execute(array($publications['idSujet']));
$nombre=$nombre->fetch();  

?>

 <a href="Commentaires.php?id=<?= $publications['idSujet']  ?>"><i class="icon-comment"></i> Commentaires</a> <b><span class="badge badge-light"><?= $nombre['count(*)']; ?></span></b>

</td>

<!-- <td>
<a href="#"><i class="icon-share"></i> Partager</a>
</td> -->

  </tr>

<?php
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