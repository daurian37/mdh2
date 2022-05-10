<!--gère la zone de recherche des membres sur la partie réseau--> 

<?php

require('fonction.php');

 ?>

<?php
if(isset($_POST['membre_reseau'])){

if(!empty(!empty($_POST['nom_membre'])) ){

		$errors=[];


try
{
	$bdd= new PDO('mysql:host=localhost;dbname=mydoctorhome','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}catch(Exception $e)
{
	die('Erreur :' .$e->getMessage());
}

$req=$bdd->prepare('select nom,prenom from utilisateurs where mail=? or prenom=?');
$req->execute(array($_POST['nom_membre'],$_POST['nom_membre']));
$donnees=$req->fetch();


if ($donnees['nom']==$_POST['nom_membre'] || $donnees['prenom']==$_POST['nom_membre']){


			header('Location:reseau.php');
		}
		else{



		
			$errors[]="Aucun résultat ne correspond à votre recherche.";
			

		}

		$req->closeCursor();
    
}

}

?>

<?php require('reseau.php'); ?>