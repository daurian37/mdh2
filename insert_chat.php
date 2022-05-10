<?php

//insert_chat.php

include('connexion_bd.php');

session_start();

if(isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name'])){

 try
{
    /*  connexion a la base de donnée   */


    $bdd= new PDO('mysql:host=localhost;dbname=mydoctorhome','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}catch(Exception $e)
{
    die('Erreur :' .$e->getMessage());
}

$requ=$bdd->query('SELECT * from chat_image');
$don = $requ->fetch();

$data = array(
 ':to_user_id'  => $_POST['to_user_id'],
 ':from_user_id'  => $_SESSION['id'],
 ':chat_message'  => $_POST['chat_message'],
 ':image' => $don['image'],
 ':status'   => '1'
);

$query = "
INSERT INTO chat_message 
(to_user_id, from_user_id, chat_message,image,status) 
VALUES (:to_user_id, :from_user_id, :chat_message, :image, :status)
";

$statement = $bdd->prepare($query);

$del=$bdd->query('TRUNCATE TABLE chat_image');

if($statement->execute($data))
{
 echo fetch_user_chat_history($_SESSION['id'], $_POST['to_user_id'], $bdd);
}

	}else{


$data = array(
 ':to_user_id'  => $_POST['to_user_id'],
 ':from_user_id'  => $_SESSION['id'],
 ':chat_message'  => $_POST['chat_message'],
 ':status'   => '1'
);

$query = "
INSERT INTO chat_message 
(to_user_id, from_user_id, chat_message,status) 
VALUES (:to_user_id, :from_user_id, :chat_message,:status)
";

$statement = $bdd->prepare($query);

if($statement->execute($data))
{
 echo fetch_user_chat_history($_SESSION['id'], $_POST['to_user_id'], $bdd);
}

	}
?>