<!-- appelle de la page fonction -->  

<?php 


require('fonction.php');
include("connexion_bd.php");

  ?>

<!-- assure la suppression du compte de l'utilisateur dans mon compte -->

                <?php
		

			                	if(isset($_POST['suprimer'])){


                    $req=$bdd->prepare('delete from utilisateurs where mail=? and password=?');   
                    $req->execute(array($_POST['mail_sup'],$_POST['password_sup']));

                }


                ?>

                	<?php require('mon_compte.php'); ?>

     <!-- fin suppression compte-->           	



<!-- assure le changement du password du compte de l'utilisateur dans mon compte -->

<?php

                try
{
    $bdd= new PDO('mysql:host=localhost;dbname=mydoctorhome','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}catch(Exception $e)
{
    die('Erreur :' .$e->getMessage());
}
		

			                	if(isset($_POST['changer'])){

			                		
                                if(!empty($_POST['mail'])  && !empty($_POST['ancienpassword']) && !empty($_POST['nouveaupassword']) && !empty($_POST['confirmerPpassword'])){

                                    $errors=[];

			                		if($_POST['nouveaupassword']==$_POST['confirmerPassword_nouveau']){


                    $req=$bdd->prepare('UPDATE utilisateurs set password=? where password=? and mail=?');   
                    $req->execute(array($_POST['nouveaupassword'],$_POST['ancienpassword'],$_POST['mail_change']));

                    header('Location:mon_compte.php');
                    echo 'mot de passe modifier avec succes! ';

                         }
                }else{

                    $errors[]="Le mot de passe n'a pas été changé veuiller respecter les champs indiqués.";
                }

}


                ?>

                	<?php require('mon_compte.php'); ?>

<!-- fin changement password-->  



                










