<?php

include_once("auth/auth.php");

?>
<!Doctype html>
<head>
<title >my Doctorhome</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="css/dist/semantic.min.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" href="css/bootstrap-responsive.min.css">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/font-awesome-4.7.0/css/font-awesome.css">
<link rel="stylesheet" href="css/bootstrap-responsive.css">

<link rel="stylesheet" href="css/bootstrap.min.css">

</head>

 <body>

<div class="headband">
        	<div class="navbar navbar-expand-lg pt-1 shadow p-3 mb-5 bg-white">
            	<a class="navbar-brand px-1 ml-5" href="projet_sublime.php"> <abbr title="MydoctorHome"><img src="Images/logo.png"/></abbr></a>
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>

<!--
                <div class="collapse navbar-collapse justified-end" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item active pl-5 pr-5 mt-3">
                        <form class="form-inline">
                        <input class="form-control mr-sm-2" type="search" placeholder="Recherche" aria-label="Search">
                        <button type="submit" class="btn btn-outline-success my-2 my-sm-0"><i class="icon-white icon-eye-open"></i> Chercher</button>
                        </form>
                        </li>
                    -->
                        <li class="nav-item px-1 ml-5">
                            <a class="nav-link text-center" href="projet_sublime.php">
                                <span>Accueil</span><br/>
                                <i class="fa p-1 fa-fw fa-home"></i>
                            </a>
                        </li>

                        <li class="nav-item px-1">
                            <a class="nav-link text-center" href="reseau.php">
                                <span>Réseau</span><br/>
                                <i class="fa p-1 fa-fw fa-users"></i>
                            </a>
                        </li>
                        <li class="nav-item dropdown px-1">
                            <a class="nav-link dropdown-toggle text-center" href="pharmacie.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span>Pharmacie</span><br/>
                                <i class="fa p-1 fa-fw fa-cart-plus"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="pharmacie_proximite.php">Pharmacie à proximité</a>
                                <a class="dropdown-item" href="pharmacie.php"> Pharmacie en ligne</a>
                            </div>
                        </li>


                        <li class="nav-item dropdown px-1">
                            <a class="nav-link dropdown-toggle text-center" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span>Notifications</span><br/>
                                <i class="fa p-1 fa-fw fa-bell"></i>



                    <?php
 try
{

    $bdd= new PDO('mysql:host=localhost;dbname=mydoctorhome','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}catch(Exception $e)
{
    die('Erreur :' .$e->getMessage());
}

                    $reponse= $bdd->query("SELECT * from notifications where statut='unread' ");
                    $donnees=$reponse->fetch();

                      $nombre=$bdd->query("SELECT count(*) from notifications where statut='unread' ");
                      $nombre=$nombre->fetch();

                            ?>

                             <span class="badge badge-danger"><?= $nombre['count(*)']; ?></span>

                                <?php
                        
                             $reponse->closeCursor();
                                ?>


                            </a>
                            

                            <div class="dropdown-menu">

    <?php

try
{
    /*  connexion a la base de donnée   */


    $bdd= new PDO('mysql:host=localhost;dbname=mydoctorhome','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}catch(Exception $e)
{
    die('Erreur :' .$e->getMessage());
}

                    $reponse= $bdd->query("SELECT * from notifications where statut='unread' ");
                        
                        ?>
                            <?php 
                                    while ($donnees = $reponse->fetch()) { ?>

                                    <a href="#">
                                       <small class="dropdown-item"><i class="p-1"><?= $donnees['date'];  ?></i></small><br>
                                        <small class="dropdown-item"><i class="p-1"><?= $donnees['nom'];  ?></i></small><br>
                                        <small class="dropdown-item"><i class="p-1"><?= $donnees['message'];  ?></i></small>
                                     
                                    </a>
                              <?php  }    ?>

                                   
                            </div>
                        </li>
                      
                        <li  class="nav-item px-1">
                            <a href="cart.php" class="nav-link">
                                <span>Panier</span><br/>
                                <i class="fa fa-fw fa-shopping-cart"></i>


<?php
 try
{

    $bdd= new PDO('mysql:host=localhost;dbname=mydoctorhome','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}catch(Exception $e)
{
    die('Erreur :' .$e->getMessage());
}



                
                      $nombre=$bdd->prepare("SELECT count(*) from panier where client=? ");

                          $user=$bdd->prepare("SELECT idAbonne from Abonne where idAbonne=? ");
                      $user->execute(array($_SESSION['id']));
                       $user=$user->fetch();    

                      $nombre->execute(array($user['idAbonne']));
                      $nombre=$nombre->fetch();

                             
                            if($nombre['count(*)']>0){
                                ?>
                             <span class="badge badge-light"><?= $nombre['count(*)']; ?></span>

                                <?php
                        }
                             $reponse->closeCursor();
                                ?>


                        </a>
                        </li>
                        <li class="nav-item px-1">
                            <a href="forum.php" class="nav-link text-center">
                                <span>Forum</span><br>
                                <i class="fa fa-fw fa-comments-o"></i>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-center" href="profil.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span>Mon compte</span><br>
                                <i class="fa fa-fw fa-user-circle-o"></i>
                                <!--<span class="caret"> </span>-->
                            </a>


                            <ul class="dropdown-menu">
                                <li><a href="profil.php" class="dropdown-item"><i class="fa fa-fw fa-user"></i> Mon profil</a></li>
                                <li><a href="#" class="dropdown-item"><i class="fa fa-fw fa-list-alt"></i> Mes commandes</a></li>
                                 <!--  <li><a href="#"><i class="icon icon-pencil"></i> Editer mon compte</a></li>
                                <li><a href="#"><i class="icon icon-trash"></i> Suprimer mon compte</a></li> -->
                                <li class="divider"></li>
                            <li>
                                <a href="deconnexion.php" class="dropdown-item"><i class="fa fa-power-off"></i> Deconnexion</a>
                            </li>

                            </ul>
                        </li>

 <?php 
 try
{
    $bdd= new PDO('mysql:host=localhost;dbname=mydoctorhome','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}catch(Exception $e)
{
    die('Erreur :' .$e->getMessage());
}

$req = $bdd->prepare('SELECT Email,Avatar from Abonne  where Email=?');
            $req -> execute(array($_SESSION['mail']));
                    $donnees=$req->fetch();

 ?>


                        <li class="nav-item pl-4"><a href="profil.php"><?php echo '<b class="nav-link pt-3" style="color:green
                        "> Bonjour'.'   '. $_SESSION['prenom'].'</b>';?></li>
                      <img src="membres/avatar/<?php echo $donnees['Email']; ?>" class="nav-link avatar" /></a> 
                         
                    </ul>
                </div>
                </div>
            </div>
