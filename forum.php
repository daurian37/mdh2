

  <?php
include_once("auth/auth.php");  


include("header.php");
?>

  <div class="container-fluid">

         <!-- zone de texte après la barre de ménu -->
<div class="headtext px-5">
        <h2 class="ui left floated header">MyDoctorHome <small>la médécine à la maison</small></h2>
        <div class="ui clearing divider"></div>
    </div>
        
    <div class="row col-lg-10 offset-1 jumbotron my-5">
            <div class="col-lg-6">
                <h2>Forum</h2>
                <p>MyDoctorHome c'est aussi un réseau d'échange et de partage
facilitant ainsi l'échange entre professionnels de santé et particuliers.<br>
Grâce à son réseau et son forum, vous pouvez consulter les publications et conseils des professionnels de santé mais aussi discuter entre amis.
Echangez vos connaissances afin de changer le monde.
                </p>
            </div>
         
            <div class="col-lg-6">
                <div>
                <img src="Images/forum.jpeg" class="imgC">
                </div>
            </div>
              
    </div>

<div class="container-fluid">

 <!-- Début menu Ajouté par ferol -->
  <div class="container">
      <ul class="nav nav-tabs">

<form method="POST" autocomplete="off">

          <div class="container">

       <div class="form-group">
      
        <input type="search"   class="form-control form-control-lg" name="recherche_forum" id="recherche_forum" placeholder="Entrer votre recherche" required="required">
       </div>

      <div id="display-results">
        
      </div>
        </form>
        </div><br>




<div class="headband">
          <div class="navbar" style="float:left">
              
                
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-center" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span>Consulter le forum</span><br>
                             
                            </a>


                            <ul class="dropdown-menu">
                               
                                <li><a href="forum.php">Toutes les catégories</a></li>
            <li><?php 

      try
    {
        $bdd=new PDO('mysql:host=localhost;dbname=mydoctorhome','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }catch(Exception $e)
    {
        die('Erreur :' .$e->getMessage());
    }

    $message=$bdd->query('SELECT * from Cat_Sujet ');

    ?>
     
      <?php
       while($forum=$message->fetch()){
    ?>
    
         
       <a href="publication.php?id=<?= $forum['idCat_Sujet']  ?>"><?= $forum['Nom_Cat'].'<br>';  ?></a>  

    
       <?php
    }
     ?>
    </a></li>                     
                         
                    </ul>
                </div>
                </div>
<ul>
        <li><a href="forum_creation_discussion.php">Créer une discussion</a></li>
        <li><a href="#">Rédiger un article</a></li>
      </ul>
   <!-- Fin menu Ajouté par ferol -->   

  <br>

    <?php

    /*gère l'insertion des messages dans le forum */
    try
    {
        $bdd=new PDO('mysql:host=localhost;dbname=mydoctorhome','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }catch(Exception $e)
    {
        die('Erreur :' .$e->getMessage());
    }

    $categorie=$bdd->query('SELECT * from Cat_Sujet');

    ?>




    <table class="table table-striped" border="2">
      <tr>
    <th style="background:green;color:white">Catégories du forum santé</th>
    <th style="background:green;color:white" width="30px">Nombre de messages</th>
    <!-- <th style="color: green">Nombre de messages</th> -->
      </tr>

      <?php   

    while ($categori = $categorie->fetch()) { ?>

       <tr>

    <td>


        <a href="publication.php?id=<?= $categori['idCat_Sujet']  ?>">
    <b><?= $categori['Nom_Cat'] ?></b> <b>

    </a>

    </td>
    <td>

         <?php

    try
    {
        $bdd=new PDO('mysql:host=localhost;dbname=mydoctorhome','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }catch(Exception $e)
    {
        die('Erreur :' .$e->getMessage());
    }
      $nombre=$bdd->prepare('SELECT count(*) from sujet_discution where idCat_Sujet=? ');

    $nombre->execute(array($categori['idCat_Sujet']));
    $nombre=$nombre->fetch();  ?>

    <b><span class="badge badge-light"><?= $nombre['count(*)']; ?></span></b>
    </td>

      </tr>

    <?php
    }

    ?>

    </table>


  </div>
</div>

</div> <br> <br> <br> <br>


<!-- js -->
<script src="js/jquery-latest.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/forum.js"></script>


  <?php
include("pied.php");

  ?>
</body>
</html>


