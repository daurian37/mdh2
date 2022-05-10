<?php

//fetch_user_chat_history.php

include('connexion_bd.php');

session_start();

echo fetch_user_chat_history($_SESSION['id'], $_POST['to_user_id'], $bdd);

?>