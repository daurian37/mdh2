 <?php
 session_start();  

  try
{
    $bdd=new PDO('mysql:host=localhost;dbname=mydoctorhome','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}catch(Exception $e)
{
    die('Erreur :' .$e->getMessage());
}
   

if(isset($_GET['t'],$_GET['id'],$_SESSION['id']) AND !empty($_GET['t'])   AND !empty($_GET['id']) ){



	$getid= (int) $_GET['id']; 
	$gett= (int) $_GET['t'];

  try
{
    $bdd=new PDO('mysql:host=localhost;dbname=mydoctorhome','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}catch(Exception $e)
{
    die('Erreur :' .$e->getMessage());
}
   

$commentaires=$bdd->prepare('SELECT idPublication from Publication where idPublication=?');
$commentaires->execute(array($getid));


if($commentaires->rowCount()==1){


if($gett==1){

$aimer=$bdd->prepare('SELECT * from like_pub where idPublication=? AND idAbonne=?');
$aimer->execute(array($getid,$_SESSION['id']));
	


if ($aimer->rowCount() == 1) {
	
$del=$bdd->prepare('DELETE from like_pub where idPublication=? AND idAbonne=?');
$del->execute(array($getid,$_SESSION['id']));

}else{

 try
{
    $bdd=new PDO('mysql:host=localhost;dbname=mydoctorhome','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}catch(Exception $e)
{
    die('Erreur :' .$e->getMessage());
}
   

$ins=$bdd->prepare('INSERT INTO like_pub (idPublication,idAbonne,Date_like) VALUES (?,?,NOW())');
$ins->execute(array($getid,$_SESSION['id']));


}

 

}else if($gett==2){
	


$del=$bdd->prepare('DELETE from like_pub where idPublication=? AND idAbonne=?');
$del->execute(array($getid,$_SESSION['id']));

}

header('Location: http://localhost:8090//mydoctorhome/projet_sublime.php?t=like&id='.$getid);
}else{

	exit('Erreur fatale');

	}
}else{

	exit('Erreur fatale');
	
	} 

?>