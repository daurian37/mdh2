<?php

session_start();

include("connexion_bd.php");

if (isset($_POST['suprimer'])) {

$errors=[];

if (isset($_POST['mail_sup'],$_POST['password_sup'],$_SESSION['mail'])) {

  try
{
    $bdd=new PDO('mysql:host=localhost;dbname=mydoctorhome','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}catch(Exception $e)
{
    die('Erreur :' .$e->getMessage());
}

if ($_POST['password_sup']==$_SESSION['password'] AND $_POST['mail_sup']==$_SESSION['mail'] ) {
  


 try
{
    $bdd=new PDO('mysql:host=localhost;dbname=mydoctorhome','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}catch(Exception $e)
{
    die('Erreur :' .$e->getMessage());
}
$select=$bdd->prepare('SELECT * from Abonne where Email=?');
$select->execute(array($_SESSION['mail']));
$select=$select->fetch();

$modifier=$bdd->prepare('DELETE from publication where idAbonne=?');
$modifier->execute(array($select['idAbonne']));

$modifier=$bdd->prepare('DELETE from produit where idAbonne=?');
$modifier->execute(array($select['idAbonne']));

$modifier=$bdd->prepare('DELETE from likes where id_membre=?');
$modifier->execute(array($select['id']));

$modifier=$bdd->prepare('DELETE from dislikes where id_membre=?');
$modifier->execute(array($select['id']));

$modifier=$bdd->prepare('DELETE from forum where nom_publicateur=?');
$modifier->execute(array($select['prenom']));

$modifier=$bdd->prepare('DELETE from commentaire_reseau where idAbonne=?');
$modifier->execute(array($select['id']));

$modifier=$bdd->prepare('DELETE from commentaires where nom=?');
$modifier->execute(array($select['prenom']));


$modifier=$bdd->prepare('DELETE from Abonne where password=? AND Email=?');
$modifier->execute(array($_POST['password_sup'],$_SESSION['mail']));

session_destroy();

header('Location: page_index_ferol.php');

}else{

  $errors[]="erreur, la suppression du compte n'a pas abouti";

}

 
}


}
 
header('Location: page_index_ferol.php');


?>