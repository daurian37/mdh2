
<?php
include_once("auth/auth.php");

require("fonction.php");
include('connexion_bd.php');

                                $id=$_GET['id'];
                                $reponse=$bdd->query("SELECT * from Publication where idPublication='$id' ");
                                $donnees=$reponse->fetch();

                        if (isset($_GET['id']) AND !empty($_GET['id'])) {
if(!is_null($donnees['Description_Pub'] )){

$ins=$bdd->prepare('INSERT into Publication (Titre_Pub,Description_Pub,idAbonne2,idAbonne,Date_Pub) values (?,?,?,?,NOW())');
$ins->execute(array($donnees['Titre_Pub'],$donnees['Description_Pub'],$_SESSION['id'],$donnees['idAbonne']));


$insert_partage=$bdd->prepare('INSERT into partage_pub_reseau (Abonne_idAbonne,Publication_idPublication)  values (?,?)');
$insert_partage->execute(array($_SESSION['id'],$donnees['idPublication']));


}else if (!is_null($donnees['Image'] )){

	$ins=$bdd->prepare('INSERT into Publication (Titre_Pub,Image,idAbonne2,idAbonne,Date_Pub) values (?,?,?,?,NOW())');
$ins->execute(array($donnees['Titre_Pub'],$donnees['Image'],$_SESSION['id'],$donnees['idAbonne']));



$insert_partage=$bdd->prepare('INSERT into partage_pub_reseau (Abonne_idAbonne,Publication_idPublication)  values (?,?)');
$insert_partage->execute(array($_SESSION['id'],$donnees['idPublication']));
                        }



header('Location: projet_sublime.php');
                             
                             } ?>