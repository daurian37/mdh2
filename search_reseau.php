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

$q=$bdd->prepare('SELECT  * from Abonne

					Where (Nom like :query OR Prenom like :query OR Email like :query ) LIMIT 20');


$q->execute([

'query'=>'%'.$query.'%'

]);

$datas=$q->fetchAll(PDO::FETCH_OBJ);

foreach ($datas as $data) { ?>
	
	<div class="display-box-user">	

<?php

if ($data->idAbonne !== $_SESSION['id']) { ?>

		<a href="info_user.php?id=<?=  $data->idAbonne?>">
			<?php
echo $data->Nom.'  '.$data->Prenom;

			?>
		</a>

	<?php	}


		?>
</div>	



	<?php
}



?>