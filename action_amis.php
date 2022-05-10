<?php
session_start();

try{
      $bdd=new PDO('mysql:host=localhost;dbname=mydoctorhome','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

  }catch(Exception $e){

      die('Erreur :' .$e->getMessage());

  }

if ($_GET['action']=="delete") {

$req=$bdd->query("DELETE FROM amis where id=".$_GET['id']);
header('Location: reseau.php');	

}

if ($_GET['action']=="add") {

$req=$bdd->prepare("INSERT into amis(user_id1,user_id2,statut) values(:user_id1, :user_id2, :statut)");
$req->execute([

"user_id1" => $_SESSION['id'],
"user_id2" => $_GET['id'],
"statut"=>1

]);
header('Location: reseau.php');	

}

if ($_GET['action']=="accept") {

$req=$bdd->query("UPDATE amis set statut='0' where id=".$_GET['id']);
header('Location: reseau.php');	

}



?>