  <?php

session_start();

/*include_once("auth/auth.php");*/
include("connexion_bd.php");
 require("fonction.php");

$message = '';

if(isset($_SESSION['id']))
{
 header('location:projet_sublime.php');
}

if(isset($_POST["connexion"]))
{
   $query = "
     SELECT * FROM Abonne
      WHERE Email = :mail
   ";
   $statement = $bdd->prepare($query);
   $statement->execute(
      array(
        ':mail' => $_POST["mail"]
       )
    );
    $count = $statement->rowCount();
    if($count > 0)
   {
    $result = $statement->fetchAll();
      foreach($result as $row)
      {
        if($_POST["password"] == $row["password"])
        {
          $_SESSION['id'] = $row['idAbonne'];
          $_SESSION['prenom'] = $row['Prenom'];
          $_SESSION['nom']=$row['Nom'];
          $_SESSION['datenaissance']=$row['Date_naissance'];
          $_SESSION['sexe']=$row['Sexe'];
          $_SESSION['numero']=$row['Numero'];
          $_SESSION['mail']=$row['Email'];
          $_SESSION['password']=$row['password'];
          $sub_query = "
          INSERT INTO login_details 
          (id) 
          VALUES ('".$row['idAbonne']."')
          ";
          $statement = $bdd->prepare($sub_query);
          $statement->execute();
          $_SESSION['login_details_id'] = $bdd->lastInsertId();
          header("location:projet_sublime.php");
        }
        else
        {
         $errors[]="Mot de passe ou adresse électronique incorrecte. L'authentification a échouée.";
        }
      }
   }
   else
   {
    $errors[]="Mot de passe ou adresse électronique incorrecte. L'authentification a échouée.";
   }
}

?>

	
		 
 <?php


include("bar_de_menu.php");

 ?>
<div class="container-fluid p-0">

    <div class="headtext px-5">
        <h2 class="ui left floated header">MyDoctorHome <small>la médécine à la maison</small></h2>
        <div class="ui clearing divider"></div>
    </div>
<!-- Début bouton login -->


<div class="modal fade" id="myModal" role="dialog" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog" role="document">
    
      <!-- Modal content-->
      <div class="modal-content">

          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Connexion</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

        <div class="modal-body">

           

          <form class="p-5" role="form" method="POST" autocomplete="off">
            <div class="form-group">
              <label for="mail"><span class="glyphicon glyphicon-user"></span> Adresse mail</label>
              <input type="email" class="form-control" id="mail" name="mail" required placeholder="nom@gmail.com" required="required">
            </div>
            <div class="form-group">
              <label for="password"><span class="glyphicon glyphicon-eye-open"></span> Mot de passe</label>
              <input type="password" class="form-control" name="password" id="password" placeholder="Enter password">
            </div>
            <div class="ui checkbox">
              <input type="checkbox" tabindex="0" value="" checked>
              <label class="mt-0">Se souvenir de moi</label>
            </div>
              <input type="submit" value="Se connecter" name="connexion" class="btn btn-success btn-block">

          </form>

        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-danger btn-xl pull-left" data-dismiss="modal"><i class="fa fa-repeat"></i></button>
            <label>Pas encore membre?  <a href="page_inscription.php">Créer un compte</a> | <a href="#">Mot de passe oublié</a> </label>    
        </div>

      </div>
      
    </div>

  </div>
  <!-- fin bouton login -->
<div class="p-0 mr-3   mt-3">
    
    
            <nav class="offset-9">
                <ul class="nav nav  ">
                   
                   <li><button type="submit" name="Connexion" class="btn btn-success btn-default px-5" id="myBtn"> Se connecter <i class=""></i></button></li>

                    <li><a href="page_inscription.php"><button type="submit"  class="btn btn-success px-5">S'inscrire <i class=""></i></button></a></li>
                </ul>
            </nav>
</div><br>
 <!-- gère l'affichage des erreurs au dessus du formulaire-->

           <?php

if(isset($errors) && count($errors) !=0 ){

    echo '<div class="alert alert-danger">

    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';

    foreach ($errors as $error) {
        
        echo $error.'<br/>';
    }

     echo '</div>';
}

 ?>
  <!-- fin-->
<div class="carousel slide pb-5 m-0 px-0" id="carouselExampleIndicators" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="Images/slide.jpg" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h5 class="titrage">Acceuil</h5>
            <p class="btext">Bienvenue dans votre plateforme socio-professionnelle médecinale Partager, discuter, acheter et vendre en ligne, bien plus encore! grâce à MyDoctorHome</p>
              <div class="">
                <a href="a_propos.php"><button class="btn btn-outline-success my-2 my-sm-0">En savoir plus </button></a>
              </div>
          </div>
        </div>
        <div class="carousel-item">
          <img src="Images/slide.jpg" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h5 class="titrage">Acceuil</h5>
            <p class="btext">Bienvenue dans votre plateforme socio-professionnelle médecinale Partager, discuter, acheter et vendre en ligne, bien plus encore! grâce à MyDoctorHome</p>
              <div class="">
                <a href="a_propos.php"><button class="btn btn-outline-success my-2 my-sm-0">En savoir plus </button></a>
              </div>
          </div>
        </div>
        <div class="carousel-item">
          <img src="Images/slide.jpg" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h5 class="titrage">Acceuil</h5>
            <p class="btext">Bienvenue dans votre plateforme socio-professionnelle médecinale Partager, discuter, acheter et vendre en ligne, bien plus encore! grâce à MyDoctorHome</p>
              <div class="">
                <a href="a_propos.php"><button class="btn btn-outline-success my-2 my-sm-0">En savoir plus </button></a>
              </div>
          </div>
        </div>
    
      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
</div>

<div class="px-0">
		<div class="row col-lg-10 offset-1 jumbotron">
            <div class="col-lg-7">
                <h2 class="titrage">Pharmacie en ligne</h2><br>
                <div class="btext">
                	<p> Fini les temps d'attente dans les pharmacies<br> Avec MyDoctorHome commander vos produits dans la pharmacie la plus proche et faites vous livrer chez vous <br>Bien plus encore, commander des produits médicals en France et à l'étranger
                							</p>                
                </div>

            </div>

            <div class="col-lg-5">
                <img src="Images/dc1.jpg" class="imgC">
            </div>

        </div>

<!--Section docteur en ligne et prise de rendez-vous-->


		<div class="row col-lg-10 offset-1 jumbotron">
            <div class="col-lg-7">
                <h2 class="titrage">Prise de rendez-vous chez le médecin et Téléconsulation</h2><br>
             
                <div class="btext">
                	<p> Fini les temps d'attente dans les pharmacies<br> Avec MyDoctorHome commander vos produits dans la pharmacie la plus proche et faites vous livrer chez vous <br>Bien plus encore, commander des produits médicals en France et à l'étranger
                							</p>                
                </div>
            </div>
            <div class="col-lg-5">
                <img src="Images/dc2.jpg" class="imgC">
            </div>

        </div>
		
<!--Section reseau-->


    <div class="row col-lg-10 offset-1 jumbotron">
        <div class="col-lg-7">
            <h2 class="titrage">Large réseau d'échange et de partage</h2><br>

            <div class="btext">
                <p> MyDoctorHome c'est aussi un réseau d'échange et de partage<br>
                MyDoctorHome facilite l'échange entre professionnels de santé et particuliers<br>
            Grâce à son réseau et son forum, vous pouvez consulter les publications et conseils des professionnels de santé mais aussi discuter entre amis
                </p>                
            </div>
        </div>

            <div class="col-lg-5">
                <img src="Images/dc3" class="imgC">
            </div>
    </div>
 </div>
 </div>
   <?php
include("pied.php");

	?>

<!-- Pour faire fonctionner le bouton login-->		
<script src="js/jquery-latest.js"></script>
<script src="js/bootstrap.min.js"></script>
<!-- fin Pour faire fonctionner le bouton login-->	

<script>
$(document).ready(function(){
  $("#myBtn").click(function(){
    $("#myModal").modal();
  });
});
</script>



	</body>
</html>