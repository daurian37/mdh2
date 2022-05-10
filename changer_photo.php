<?php
session_start();

include("connexion_bd.php");

$reponse=$bdd->prepare("SELECT * from Abonne where idAbonne=?");
$reponse->execute(array($_SESSION['id']));
$reponse=$reponse->fetch();

if(isset($_POST['modifier'])){


		$errors=[];

           if(isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name'])){

	
	$tailleMax = 2097152;
	$extensionsValides = array('jpeg','jpg','png');

	               if($_FILES['avatar']['size']<= $tailleMax){ 

		$extensionsUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));

		                   if(in_array($extensionsUpload, $extensionsValides)){

			$chemin = "membres/avatar/".$_SESSION['mail'].".".$extensionsUpload;

			$resultat = move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin);

			                   if($resultat){ 

				try
{
	$bdd= new PDO('mysql:host=localhost;dbname=mydoctorhome','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}catch(Exception $e)
{
	die('Erreur :' .$e->getMessage());
}

					$req = $bdd->prepare('UPDATE Abonne set avatar= ? where Email=?');
					$req -> execute(array($_FILES['avatar']['name'],$_SESSION['mail']));
					$req->closeCursor();


						
			                                              }
			else
			{
				$errors[]="Erreur durant l'importation de votre photo de profil";
			}

		                                                                     }
		else
		{

			$errors[]="Votre photo de profil ne doit être au format jpg";
		}
                                              }
		else
		{
			$errors[]="Votre photo de profil ne doit pas dépasser 2 Mo";
		}
	
                                            }

								}
				

?>


	<?php header('Location:profil.php'); ?>

	<?php



if (isset($_POST['modifier_login'])) {



if (isset($_POST['mail_change'],$_POST['ancienpassword'],$_POST['nouveaupassword'],$_POST['confirmerPassword_nouveau'],$_SESSION['mail'])) {

  try
{
    $bdd=new PDO('mysql:host=localhost;dbname=mydoctorhome','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}catch(Exception $e)
{
    die('Erreur :' .$e->getMessage());
}

if ($_POST['ancienpassword']==$_SESSION['password']) {
  
if ($_POST['nouveaupassword']==$_POST['confirmerPassword_nouveau']) {


 try
{
    $bdd=new PDO('mysql:host=localhost;dbname=mydoctorhome','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}catch(Exception $e)
{
    die('Erreur :' .$e->getMessage());
}


$modifier=$bdd->prepare('UPDATE Abonne set password=? where Email=?');
$modifier->execute(array($_POST['nouveaupassword'],$_SESSION['mail']));
 

        $_SESSION['password']=$_POST['nouveaupassword'];




  
}else{

  $errors[]= "les deux mot de passe sont differents";

}


}else{

  $errors[]= "ancien mot de passe incorret";

}

 
}


}
 


header('Location: profil.php');

  ?>	

   <?php



if (isset($_POST['modifier_profil'])) {



if (isset($_POST['nom'],$_POST['prenom'],$_POST['datenaissance'],$_POST['sexe'],$_POST['numero'],$_SESSION['mail'])) {
  
  try
{
    $bdd=new PDO('mysql:host=localhost;dbname=mydoctorhome','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}catch(Exception $e)
{
    die('Erreur :' .$e->getMessage());
}

$select=$bdd->prepare('SELECT * from Abonne where idAbonne=?');
$select->execute(array($_SESSION['id']));
$sel=$select->fetch();

/*$reponse=$bdd->prepare('SELECT * from publication_acceuil where nom_publicateur=?');
$reponse->execute(array($sel['prenom']));
$rep=$reponse->fetch();

$modifier=$bdd->prepare('UPDATE publication_acceuil set nom_publicateur=? where nom_publicateur=?');
$modifier->execute(array($_POST['prenom'],$rep['nom_publicateur']));
 
$reponse=$bdd->prepare('SELECT * from Commentaires where nom=?');
$reponse->execute(array($sel['prenom']));
$repe=$reponse->fetch();

$modifier=$bdd->prepare('UPDATE Commentaires set nom=? where nom=?');
$modifier->execute(array($_POST['prenom'],$repe['nom']));

$reponse=$bdd->prepare('SELECT * from forum where nom_publicateur=?');
$reponse->execute(array($sel['prenom']));
$repet=$reponse->fetch();

$modifier=$bdd->prepare('UPDATE forum set nom_publicateur=? where nom_publicateur=?');
$modifier->execute(array($_POST['prenom'],$repet['nom_publicateur']));*/

$modifier_profil=$bdd->prepare('UPDATE Abonne set Nom=?,Prenom=?,Date_naissance=?,Sexe=?,Numero=? where idAbonne=?');

$modifier_profil->execute(array($_POST['nom'],$_POST['prenom'],$_POST['datenaissance'],$_POST['sexe'],$_POST['numero'],$_SESSION['id'] ));

        $_SESSION['nom']=$_POST['nom'];
        $_SESSION['prenom']=$_POST['prenom'];
        $_SESSION['datenaissance']=$_POST['datenaissance'];
        $_SESSION['sexe']=$_POST['sexe'];
        $_SESSION['numero']=$_POST['numero'];



}


}
 

?>

<?php header('Location: profil.php'); ?>