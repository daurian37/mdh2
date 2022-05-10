<!--appelled e la page fonction-->
<?php

session_start();


require('fonction.php');

/*  try catch pour capturer les erreurs   */

include("connexion_bd.php");

$reponse=$bdd->query("SELECT * from Produit");

/*  vérifie si les differents champs ne sont pas vide   */
if(!empty($_POST['mail']) && !empty($_POST['nom_produit']) && !empty($_POST['categ_produit']) && !empty($_POST['desc_produit']) && !empty($_POST['prix']) && !empty($_POST['stock']) && !empty($_POST['password'])  && !empty($_POST['utilisation'])  && !empty($_POST['composition']) ){

		$errors=[];


	if ($_POST['password']!=$_SESSION['password']){

		 $errors[]="Votre mot de passe doit être identique avec celui que vous avez créé ce compte";
}


		else if (! filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)){
  $errors[]="Adresse mail invalide";

   } 

/*  gère la validité des emails en back end... never trust user input...lol  */


	else if ($_POST['mail']!=$_SESSION['mail']){
  $errors[]="Votre E-mail doit être identique avec celui que vous avez créé ce compte";

   } 


if(isset($_FILES['image']) AND !empty($_FILES['image']['name'])){

	
	$tailleMax = 2097152;
	$extensionsValides = array('jpeg','jpg','png');

	if($_FILES['image']['size']<= $tailleMax){   /* strtolower(fonction permettant demettre le contenu en minuscule)   */

		$extensionsUpload = strtolower(substr(strrchr($_FILES['image']['name'], '.'), 1));

		if(in_array($extensionsUpload, $extensionsValides)){

			$chemin = "membres/image/".$_FILES['image']['name'].".".$extensionsUpload;

			$resultat = move_uploaded_file($_FILES['image']['tmp_name'], $chemin);

			if($resultat){ 

				try
{
	$bdd= new PDO('mysql:host=localhost;dbname=mydoctorhome','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}catch(Exception $e)
{
	die('Erreur :' .$e->getMessage());
}

					$req=$bdd->prepare('INSERT into Produit(idCat_Pro,Nom_Pro,image_Pro,Prix_Pro,Description_Pro,Qte_Pro,Utilisation_Pro,Composition_Pro,idAbonne) values (?,?,?,?,?,?,?,?,?)');

/* permet de ne pas afficher le password en clair dans la base de donnée pour la sécurité   */


$req->execute(array($_POST['categ_produit'],$_POST['nom_produit'],$_FILES['image']['name'],$_POST['prix'],$_POST['desc_produit'],$_POST['stock'],$_POST['utilisation'],$_POST['composition'],$_SESSION['id']));	
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


   	header('Location:pharmacie.php');

   

   		$req->closeCursor();
   }
   else{

   	/*  permet de garder le contenu du formulaire quand l'utilisateur se trompe en le remplissant à l'inscription */

   	save_input_data();
   }
			}
	


		/*	clear_input_data();*/

    
?>
<!-- pour dire que ces instructions sont liées a la page_inscription.php  -->
	
	<?php require('pharmacie.php'); ?>
	

