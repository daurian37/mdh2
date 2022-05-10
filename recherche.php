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

$q=$bdd->prepare('SELECT idAbonne,Nom,prenom,Email from Abonne

					Where (Nom like :query OR Prenom like :query OR Email like :query ) LIMIT 20');


$q->execute([

'query'=>'%'.$query.'%'

]);

$datas=$q->fetchAll(PDO::FETCH_OBJ);

foreach ($datas as $data) { ?>



	<div class="display-box-user">

<?php

if ($data->idAbonne !== $_SESSION['id']) { ?>

	<img  src="membres/avatar/<?php echo $data->Email; ?>" width="35"  class="img-circle" /> 
	<?php
		echo '<b><a style="color:yellow" class="start_chat" data-touserid="'.$data->idAbonne.'" data-tousername="'.$data->prenom.'">'.$data->Nom.' '.$data->prenom.'</a></b>';
}


		?>
</div>	



	<?php
}



?>