
<!--appelled e la page fonction-->
<?php
session_start();

include("connexion_bd.php");
require('fonction.php');
?>


<?php
/*  try catch pour capturer les erreurs   */



/*  vérifie si les differents champs ne sont pas vide   */
if(!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['datenaissance']) && !empty($_POST['sexe']) && !empty($_POST['numero']) && !empty($_POST['mail']) && !empty($_POST['password']) && !empty($_POST['confirmerPassword']) && !empty($_POST['profession']) ){

		$errors=[];


	if ($_POST['password']!=$_POST['confirmerPassword']){

		 $errors[]="Les deux mots de passe ne concordent pas !";
}

/*  taille du mot de passe doit être >4 caractères  */
else if(mb_strlen($_POST['password'])<4){

$errors[]="Mot de passe trop court (Minimum 4 caractères)";
		}

/*  gère la validité des emails en back end... never trust user input...lol  */


		else if (! filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)){
  $errors[]="Adresse mail invalide";

   } 

/* vérifie si lemailexiste déja dans la base de donnés du site  */
   else if (is_already_in_use('Email',$_POST['mail'],'Abonne')){
  $errors[]="Adresse électronique déjà utilisé par un autre utilisateur";
}

if(isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name'])){

	
	$tailleMax = 2097152;
	$extensionsValides = array('jpeg','jpg','png');

	if($_FILES['avatar']['size']<= $tailleMax){

		$extensionsUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));

		if(in_array($extensionsUpload, $extensionsValides)){

			$chemin = "membres/avatar/".$_POST['mail'].".".$extensionsUpload;

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
					$req -> execute(array(implode("", $_FILES['avatar']),$_POST['mail']));
					$req->closeCursor();


						
			}
			else
			{
				$errors[]="Erreur durant l'importation de votre photo de profil";
			}

		}
		else
		{

			$errors[]="Votre photo de profil  doit être au format jpg";
		}
}
		else
		{
			$errors[]="Votre photo de profil ne doit pas dépasser 2 Mo";
		}
	
}


if(isset($_FILES['attestation']) AND !empty($_FILES['attestation']['name'])){

	
	$tailleMax = 2097152;
	$extensionsValides = array('pdf','docx'	);

	if($_FILES['attestation']['size']<= $tailleMax){

		$extensionsUpload = strtolower(substr(strrchr($_FILES['attestation']['name'], '.'), 1));

		if(in_array($extensionsUpload, $extensionsValides)){

			$chemin = "membres/attestation/".$_POST['mail'].".".$extensionsUpload;

			$resultat = move_uploaded_file($_FILES['attestation']['tmp_name'], $chemin);

			if($resultat){

				try
{
	$bdd= new PDO('mysql:host=localhost;dbname=mydoctorhome','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}catch(Exception $e)
{
	die('Erreur :' .$e->getMessage());
}

					$req = $bdd->prepare('UPDATE Abonne set Attestation= ? where Email=?');
					$req -> execute(array(implode("", $_FILES['attestation']),$_POST['mail']));
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

if(count($errors)==0) {

//envoie d'un mail d'activation

	/*$to=$_POST['mail'];
	$subject=WEBSITE_NAME. " - ACTIVATION DE COMPTE";
	$token=sha1($_POST['nom'].$_POST['mail'].$_POST['password']);

	ob_start();

	require('mail.php');

	$content=ob_get_clean();

	$headers = 'MIME-Version: 1.0' . "\r\n";
	$headers ='Content-type: text/html;  charset=iso-8859-1' . "\r\n";


	mail($to, $subject, $content, $headers);*/

	//informer l'user pour qu'il vérifie sa boite de restore_exception_handler()

	/*echo "mail d'activation envoyé !";*/

//*********************************************
try
{
	$bdd= new PDO('mysql:host=localhost;dbname=mydoctorhome','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}catch(Exception $e)
{
	die('Erreur :' .$e->getMessage());
}

/*  enregistrement de l'utilisateur  */

$req=$bdd->prepare('INSERT into Abonne (Avatar,Nom,Prenom,Date_naissance,Sexe,Numero,Email,password,Profession,Attestation) values (?,?,?,?,?,?,?,?,?,?)');

/* permet de ne pas afficher le password en clair dans la base de donnée pour la sécurité   */

$password=password_hash($_POST['password'], PASSWORD_BCRYPT);

$req->execute(array(implode($_FILES['avatar'],''),$_POST['nom'],$_POST['prenom'],$_POST['datenaissance'],$_POST['sexe'],$_POST['numero'],$_POST['mail'],$_POST['password'],$_POST['profession'],$_FILES['attestation']));	
		
		 

			$_SESSION['nom']=$_POST['nom'];
		    $_SESSION['prenom']=$_POST['prenom'];
		    $_SESSION['datenaissance']=$_POST['datenaissance'];
		    $_SESSION['sexe']=$_POST['sexe'];
		    $_SESSION['numero']=$_POST['numero'];
		    $_SESSION['mail']=$_POST['mail'];
		     $_SESSION['password']=$_POST['password'];
		     $_SESSION['profession']=$_POST['profession'];
		     $_SESSION['avatar']=$_FILES['avatar'];
		      $_SESSION['attestation']=$_FILES['attestation'];

   	header('Location:projet_sublime.php');


  $req->closeCursor(); 

   		
   }
   
   	}



/*<!-- pour dire que ces instructions sont liées a la page_inscription.php  -->*/
	
require('inscription_espace_pro.php'); 

?>
	

