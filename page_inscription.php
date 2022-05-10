
	
 <?php
session_start();



require('fonction.php');
include("bar_de_menu.php");

 ?>



    <div class="headtext px-5">
        <h2 class="ui left floated header">MyDoctorHome <small>la médécine à la maison</small></h2>
        <div class="ui clearing divider"></div>
    </div>

<div class="container-fluid p-5">

        	<h2 style="text-align:center;color:green" class="col-lg-4 offset-4">Inscription</h2> <br><br>
      

 
        
        <div class="col-lg-4 offset-4">
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

</div>

            
            
            
            <form form class="col-lg-4 offset-4" action="enregistrement_inscription.php" method="POST" enctype="multipart/form-data">
                <fieldset class="jumbotron px-5">
              <div class="form-group">
                <label for="nom"><b>Nom(S):</b></label>
                <input  type="text" class="form-control" value="<?= get_input('nom') ?>" name="nom" id = "nom" placeholder="entrez votre nom" required="required">
              </div>
              <div class="form-group">
                <label for="prenom"><b>Prénom(S):</b></label>
                <input  type="text" class="form-control" value="<?= get_input('prenom') ?>" name="prenom" id = "prenom" placeholder="entrez votre prénom" required="required">
              </div>
              <div class="form-group">
                <label for="datenaissance"><b>Date de naissance :</b></label>
                <input  type="date" class="form-control" value="<?= get_input('datenaissance') ?>" name="datenaissance" id = "datenaissance" required="required">
              </div>
              <div class="form-group">
                <label for="sexe"><b>Sexe :</b></label>
                <input  type="radio" class="form-control" name="sexe" id = "sexe"  value="M">M  <input  type="radio" class="form-control" name="sexe" id = "sexe" required="required" value="F">F<br><br>
              </div>
              <div class="form-group">
                <label for="numero"><b>Numéro de mobile :</b></label>
                <input  type="tel" class="form-control" value="<?= get_input('numero') ?>" name="numero" id = "numero" required="required">
              </div>
              <div class="form-group">
                  <label class="control-label" for="mail"><b>Adresse électronique :</b></label>
                  <div class="form-group">
                    <div class="input-group-prepend">
                      <span class=""><i class="fa fa-envelope"></i></span>
                    </div>
                      <input class="form-control" id="mail"  name="mail" type="email" value="<?= get_input('mail') ?>"  required="required">
                  </div>
              </div>
              <div class="form-group">
                <label for="password"><b>Mot de passe :</b></label>
                <input  type="password" class="form-control" name="password" id = "password" required="required">
              </div>
                
              <div class="form-group">
                <label for="confirmerPassword"><b>Confirmer mot de passe :</b></label>
                <input  type="password" class="form-control" name="confirmerPassword" id = "confirmerPassword" required="required">
              </div>
                
               <div class="form-group">
                <label><b>Avatar (format "JPG" moins de "2 Mo")  :</b></label>
                <input  type="file"  name="avatar" id="avatar" required="required">
<!--                 <label class="custom-file-label" for="avatar">format "JPG" moins de "2 Mo"</label>
 -->              </div><br>

               <div class="form-group">
                <button type="submit"  class="form-control btn btn-success">Inscription</button>
              </div>
                </fieldset>
            </form>

               <p style="color:black"> En cliquant sur Inscription, vous acceptez nos conditions générales et découvrez comment nous recueillons, utilisons et partageons vos données et comment nous utilisons les cookies.<br><br><a href="page_agree.php">Nos conditions générales</a></p><br>
          
            <p> <h6>Vous avez déjà un compte ? <a href="page_index_ferol.php" class="lien">Connectez-vous</a></h6></p>
        <p><h5>Vous êtes un professionnel ? Inscrivez-vous dans <a href="inscription_espace_pro.php" class="lien"> l'Espace Pro</a></h5></p>
      
          
    </div>

<!-- js -->
<script src="js/jquery-latest.js"></script>
<script src="js/bootstrap.min.js"></script>







    <?php  include("pied.php");  ?>







	</body>
</html>