<?php

session_start();
require('fonction.php');

extract($_POST);
try
{
    $bdd= new PDO('mysql:host=localhost;dbname=mydoctorhome','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}catch(Exception $e)
{
    die('Erreur :' .$e->getMessage());
}

$q=$bdd->prepare('SELECT id_pharmacie, nom_pharmacie,ville_pharmacie from pharmacie

					Where (nom_pharmacie like :query OR ville_pharmacie like :query ) LIMIT 20');


$q->execute([

'query'=>'%'.$query.'%'

]);

$datas=$q->fetchAll(PDO::FETCH_OBJ);

foreach ($datas as $data) { ?>
	
	<div class="display-box-user">	
		<a href="commande.php?id_pharmacie=<?=  $data->id_pharmacie ?>">
			<?php
echo $data->nom_pharmacie.' de '.$data->ville_pharmacie;

			?>
		</a>
</div>	



	<?php
}



?>