<?php

require('fonction.php');
include("connexion_bd.php");

 ?>


<?php

if(!empty(!empty($_POST['mail']) && !empty($_POST['password'])) ){

		$errors=[];



$req=$bdd->prepare('select nom,prenom,datenaissance,sexe,numero,mail,password from utilisateurs where mail=? and password=?');
$req->execute(array($_POST['mail'],$_POST['password']));

$donnees=$req->fetch();

if ($donnees['mail']==$_POST['mail'] && $donnees['password']==$_POST['password']){

	session_start();

	try
{
	$bdd= new PDO('mysql:host=localhost;dbname=mydoctorhome','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}catch(Exception $e)
{
	die('Erreur :' .$e->getMessage());
}

/*  traitement de la requete de l'utilisateur voulant se connecter  */

$req=$bdd->prepare('select nom,prenom,datenaissance,sexe,numero,mail,password from utilisateurs where mail=? and password=?');
$req->execute(array($_POST['mail'],$_POST['password']));

$donnees=$req->fetch();
$_POST['nom']=$donnees['nom'];
$_POST['prenom']=$donnees['prenom'];
$_POST['datenaissance']=$donnees['datenaissance'];
$_POST['sexe']=$donnees['sexe'];
$_POST['numero']=$donnees['numero'];
$_POST['mail']=$donnees['mail'];
$_POST['password']=$donnees['password'];

			$_SESSION['nom']=$_POST['nom'];
		    $_SESSION['prenom']=$_POST['prenom'];
		    $_SESSION['datenaissance']=$_POST['datenaissance'];
		    $_SESSION['sexe']=$_POST['sexe'];
		    $_SESSION['numero']=$_POST['numero'];
		    $_SESSION['mail']=$_POST['mail'];
		     $_SESSION['password']=$_POST['password'];


			header('Location:projet_sublime.php');
		}
		else{



		
			$errors[]="Mot de passe ou adresse électronique incorrecte. L'authentification a échouée.";
			

		}

		$req->closeCursor();
    
}


?>

<?php require('page_pro.php'); ?>