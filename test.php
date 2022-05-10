<?php

include_once("auth/auth.php");


include('connexion_bd.php');

if(!isset($_SESSION['id']))
{
 header('location:page_index_ferol.php');
}
?>
 	<!--barre de navigation--> 
 	 <?php

include("header.php");
?>
 <div class="container-fluid">
        <div class="headtext px-5 py-3">
            <h2 class="ui left floated header">MyDoctorHome <small>la médécine à la maison</small></h2>
            <div class="ui clearing divider"></div>
        </div>


