<!-- @smeth 
system de gestion des autentification des utilisateurs

-->


<?php
session_start();
if(isset($_SESSION['id']) && isset($_SESSION['mail'])){

    $t1 = $_SESSION['id'];
    $t2 = $_SESSION['mail'];
    

  }else{

    header("Location: page_index_ferol.php");
    exit;
  }

?>

