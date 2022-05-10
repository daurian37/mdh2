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

$q=$bdd->prepare('SELECT  * from sujet_discution

					Where (Description_Sujet like :query OR Titre_Sujet like :query ) LIMIT 20');


$q->execute([

'query'=>'%'.$query.'%'

]);

$datas=$q->fetchAll(PDO::FETCH_OBJ);

foreach ($datas as $data) { ?>
	
	<div class="display-box-user">	

<?php

if ($data->idAbonne !== $_SESSION['id']) { ?>

		<a href="commentaires.php?id=<?=  $data->idAbonne?>">
			<?php
echo $data->Description_Sujet;

			?>
		</a>

	<?php	}


		?>
</div>	



	<?php
}



?>