<?php

include_once("auth/auth.php");


include("header.php");

try{
      $bdd=new PDO('mysql:host=localhost;dbname=mydoctorhome','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

  }catch(Exception $e){

      die('Erreur :' .$e->getMessage());

  }

 $query=$bdd->prepare("SELECT * from amis where user_id1 = ? OR user_id2 = ? ");
$query->execute(array($_SESSION['id'],$_SESSION['id']));
$datas=$query->fetchAll();

$user_check[] =$_SESSION['id'];

?>


<h3>Bonjour <?= $_SESSION['prenom']  ?></h3><br><br>



<h3>Listes d'amis</h3>
<?php

for ($i=0; $i <sizeof($datas) ; $i++) { 
	
	if ($datas[$i]['user_id1']==$_SESSION['id']) {

echo $datas[$i]['user_id2']."<a href='action_amis.php?action=delete&id=".$datas[$i]['id']  . "'>Supprimer</a>";

	$user_check[]=$datas[$i]['user_id2'];


if ($datas[$i]['statut']==true) {
	
	echo "(en attente d'être accepté) ";
}

	}else{

if ($datas[$i]['statut']==false) {
	
	echo $datas[$i]['user_id1']."<a href='action_amis.php?action=delete&id=".$datas[$i]['id']  . "'>Supprimer</a>"	;

	$user_check[]=$datas[$i]['user_id1'];
}


	}

	echo '<br><br><br>'; 
}

?>



<br><br><br><br><br><br>





<h3>Demande d'amis</h3>

<?php

for ($i=0; $i <sizeof($datas) ; $i++) { 

if ($datas[$i]['statut']==true && $datas[$i]['user_id2']==$_SESSION['id'] ) {
	
	echo $datas[$i]['user_id1']."<a href='action_amis.php?action=accept&id=".$datas[$i]['id']  . "	'>Accepté</a> <a href='action_amis.php?action=delete&id=".$datas[$i]['id']  . "'>Refusé</a>";

	$user_check[]=$datas[$i]['user_id1'];
}

}

?>



<br><br><br><br><br><br>

<h3>Autres utilisateurs</h3>

<?php
$query=$bdd->query("SELECT * from utilisateurs");
$data=$query->fetchAll();

 for ($i=0; $i <sizeof($data) ; $i++) { 
 	
 	if (!in_array($data[$i]['id'], $user_check)) {
 		
 		echo $data[$i]['id']."<a href='action_amis.php?action=add&id=".$data[$i]['id']  . "'>Inviter</a>";
 	}
 }
?><br><br><br><br><br><br>