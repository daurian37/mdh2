<?php


if (isset($_POST['commenter'])) {



  if(isset($_POST['nom_publicateur'],$_POST['categorie'],$_POST['message'],$_POST['titre']) AND !empty($_POST['nom_publicateur']) AND !empty($_POST['categorie']) AND !empty($_POST['message'])AND !empty($_POST['titre']) ){

echo "string";

$nom_publicateur=htmlspecialchars($_POST['nom_publicateur']);
  $categorie=htmlspecialchars($_POST['categorie']);
  $message=htmlspecialchars($_POST['message']);
   $titre=htmlspecialchars($_POST['titre']);



      try
    {
        $bdd=new PDO('mysql:host=localhost;dbname=mydoctorhome','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }catch(Exception $e)
    {
        die('Erreur :' .$e->getMessage());
    }

$ins=$bdd->prepare('INSERT into forum (id_categorie,message,titre,nom_publicateur,date_publication) values (?,?,?,?,NOW())');

$requete=$bdd->prepare('SELECT * from categorie_forum where description=?');
$requete->execute(array($categorie));
$donnees=$requete->fetch();

$ins->execute(array($donnees['id'],$message,$titre,$nom_publicateur));


header('Location:forum.php');




  }

}



?>

