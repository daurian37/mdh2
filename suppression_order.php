<?php 
session_start();


if(isset($_GET['id']) AND !empty($_GET['id'])){

$getid=htmlspecialchars($_GET['id']);

    try
{
  $bdd= new PDO('mysql:host=localhost;dbname=mydoctorhome','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}catch(Exception $e)
{
  die('Erreur :' .$e->getMessage());
}

$requete=$bdd->prepare('SELECT * from achat where client=?');
$requete->execute(array($_SESSION['id']));
$requete=$requete->fetch();


$requete=$bdd->prepare('DELETE from achat where id=?');
$requete->execute(array($getid));
header('Location: order.php');
	
}
?>