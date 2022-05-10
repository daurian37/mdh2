<?php


include("connexion_bd.php");
 $reponse= $bdd->query('UPDATE notifications set statut=read  where statut=unread');

header('Location:projet_sublime.php');


?>