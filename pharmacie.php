<?php

include_once("auth/auth.php");
?>

<?php
include("header.php");

?>

     <div class="container-fluid">
    
               <div class="headtext px-5">
                  <h2 class="ui left floated header">MyDoctorHome <small>la médécine à la maison</small></h2>
                  <div class="ui clearing divider"></div>
              </div>

    <div class="row col-lg-10 offset-1 jumbotron my-5">
                      <div class="col-lg-6">
                          <h2 class="">Pharmacie en ligne</h2>
                          <p>Fini les temps d'attente dans les pharmacies
          Avec MyDoctorHome commander vos produits dans la pharmacie la plus proche et faites vous livrer chez vous
          Bien plus encore, commander des produits médicals en France et à l'étranger

                          </p>
                      </div>   
        <div class="col-lg-6">
                <div class="span4 offset4">
                <img src="Images/dc4.jpg" class="imgC">
                </div>

            </div>
    </div>
    <!-- </div> -->
    

<!-- ****************************************************************************************  -->

<div class="container-fluid"> <!-- div container fluid  -->
         

           <h2 style="color:green">Nos services pharmaceutiques</h2><br>


<div class="headband">   <!-- div head band  -->


                                      <div class="navbar" style="float:left"> <!-- div class navbar  -->
                                          
                                            
     <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-center" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <span>Consulter nos produits</span><br>
                    </a>

              <ul class="dropdown-menu">
                                                           
                        <li><a href="all_product.php" class="dropdown-item">Tous les produits</a></li>
                               <li class="dropdown-item">
                                <?php 

                                  try
                                {
     $bdd=new PDO('mysql:host=localhost;dbname=mydoctorhome','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
                                }catch(Exception $e)
                                {
                                    die('Erreur :' .$e->getMessage());
                                }

                                $message=$bdd->query('SELECT * from cat_Pro ');

                                   while($forum=$message->fetch()){
                                ?>
                                
                                     
                                   <a href="product.php?id=<?= $forum['idCat_Pro']  ?>"><?= $forum['Nom_Cat_Pro'];  ?></a><br>  

                                
                                   <?php
                                }
                                 ?>
                                </a></li>
                                                          
                                                        </ul>
                                                    </li>
                                                     
                                                </ul>
                                            </div>  <!--fermeture div class nav bar  -->
                </div><!-- div headband fermeture -->
            <br> <br> <br> <br> <br>

     

<ul class="nav nav-tabs" id="myTab" role="tablist">

                   <?php
try
{
  /*  connexion a la base de donnée   */


  $bdd= new PDO('mysql:host=localhost;dbname=mydoctorhome','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}catch(Exception $e)
{
  die('Erreur :' .$e->getMessage());
}

$req=$bdd->prepare('SELECT * from Abonne where Email=?');
$req->execute(array($_SESSION['mail'])); 
$donnees=$req->fetch();

if($donnees['Profession']!=null){

  ?>

 <li class="nav-item">
 <a class="nav-link active" id="enregistrer-tab" data-toggle="tab" href="#enregistrer"
role="tab" aria-controls="enregistrer" aria-selected="true"><i class="fa fa-save"></i> Enregistrer un produit</span></a>
 </li>
 <li class="nav-item">
 <a class="nav-link" id="enregistrer-tab" data-toggle="tab" href="#produit_enregistrer"
role="tab" aria-controls="produit_enregistrer" aria-selected="false"><i class="fa fa-folder-open"></i> Produits enregistrés</a>
 </li>

<?php
}

?>


 <li class="nav-item">
 <a class="nav-link" id="info-tab" data-toggle="tab" href="#info"
role="tab" aria-controls="info" aria-selected="false"><i class="fa fa-plus"></i> Plus d'informations</a>
 </li>
</ul>
<div class="tab-content" id="myTabContent">


 <div class="tab-pane fade show active" id="produit_enregistrer" role="tabpanel" arialabelledby="produit_enregistrer-tab">

<br>

   <div class="page-header">
      <h5 style="color:green">MyDoctorHome <small>la médécine à la maison</small></h5>
    </div>
<br>

<div class="container-fluid"> <!-- div container fluid  -->

    <table class="table table-striped" border="2">
  <tr>
<th style="background:green;color:white">Catégories des produits</th>
<th style="background:green;color:white" width="30px">Nombre de produits enregistré</th>

  </tr>

 <?php
try
{


  $bdd= new PDO('mysql:host=localhost;dbname=mydoctorhome','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}catch(Exception $e)
{
  die('Erreur :' .$e->getMessage());
}

$reponse=$bdd->query("SELECT * from Cat_Pro");
  

while ($categori = $reponse->fetch()) { ?>

   <tr>

<td>


    <a href="liste_produit.php?id=<?= $categori['idCat_Pro']  ?>">
<b><?= $categori['Nom_Cat_Pro'] ?></b> <b>

</a>

</td>
<td>

     <?php


  $nombre=$bdd->prepare('SELECT count(*) from produit where  idAbonne=? and idCat_Pro=? ');

$nombre->execute(array($_SESSION['id'],$categori['idCat_Pro']));
$nombre=$nombre->fetch();  ?>

<b><span class="badge badge-light"><?= $nombre['count(*)']; ?></span></b>
</td>

  </tr>

<?php
}

?>

</table>
   


    </div> <!-- div container fluid fermeture -->

     </div> <!-- div produit enregistrer fermeture-->
  

                    <div class="tab-pane " id="produit">  <!-- div produit -->
       <div class="page-header">
      <h5 style="color:green">MyDoctorHome <small>la médécine à la maison</small></h5>
    </div>

    <p>Cher(e)s membre vous trouverez ici tout les produits disponibles sur notre plateforme.</p><br><br><br>
       


 <table class="table table-striped" border="2">
  <tr>
<th style="background:green;color:white">Catégories des produits</th>
<th style="background:green;color:white" width="30px">Nombre de produits enregistré</th>

  </tr>

 <?php
try
{


  $bdd= new PDO('mysql:host=localhost;dbname=mydoctorhome','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}catch(Exception $e)
{
  die('Erreur :' .$e->getMessage());
}

$reponse=$bdd->query("SELECT * from Cat_Pro");
  

while ($categori = $reponse->fetch()) { ?>

   <tr>

<td>


    <a href="liste_produit.php?id=<?= $categori['idCat_Pro']  ?>">
<b><?= $categori['Nom_Cat_Pro'] ?></b> <b>

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
  $nombre=$bdd->prepare('SELECT count(*) from produit where idCat_Pro=? AND idAbonne=? ');

$nombre->execute(array($categori['Nom_Cat_Pro'],$_SESSION['id']));
$nombre=$nombre->fetch();  ?>

<b><span class="badge badge-light"><?= $nombre['count(*)']; ?></span></b>
</td>

  </tr>

<?php
}

?>

</table>

    </div>  <!-- div produit fermeture  -->


 <div class="tab-pane fade" id="enregistrer" role="tabpanel" arialabelledby="enregistrer-tab">

  <br>
                     

<div class="container-fluid">  <!-- div container fluid  -->

<p> Enregistrer votre produit en ligne afin d'en vendre sans avoir besoin de vous deplacer</p>

<?php
try
{
  /*  connexion a la base de donnée   */


  $bdd= new PDO('mysql:host=localhost;dbname=mydoctorhome','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}catch(Exception $e)
{
  die('Erreur :' .$e->getMessage());
}

$req=$bdd->prepare('SELECT * from Abonne where idAbonne=?');
$req->execute(array($_SESSION['id'])); 
$donnees=$req->fetch();

if($donnees['Profession']!=null){
  echo '
Bonjour cher(e)  '.$donnees['Profession'];

?>
<div class="col-lg-3 offset-0" style="color:blue">  <!-- div cols-lg-3 -->
            <form action="enregistrer_produit.php" method="post" enctype="multipart/form-data">


            <div class="form-group">
            <input name="mail" id="mail" class="form-control" type="hidden" placeholder="Entrer votre E-mail" <?php if(isset( $_SESSION['mail'])){echo 'value="'. $_SESSION['mail'].'"'; }    ?>  required="required">
            </div>

            <div class="form-group">
        <label  class="control-label" for="nom_produit">Nom du produit à enregistrer :</label>
              
            <input  name="nom_produit"  class="form-control" id="nom_produit" type="text" placeholder="Nom du produit" required="required">
         </div>
<div class="form-group">
         <label for="image">Image du produit (format "JPG" moins de "2 Mo") :</label>
            <input  type="file" name="image"  id = "image" required="required"><br><br>
</div>

<div class="form-group">
<label class="control-label" for="produit">Mentionner la catégorie du produit :</label>
<select id="categ_produit" class="form-control" name="categ_produit" required="required" >
<option>Catégorie du produit</option>
<?php
try
{


  $bdd= new PDO('mysql:host=localhost;dbname=mydoctorhome','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}catch(Exception $e)
{
  die('Erreur :' .$e->getMessage());
}

$reponse=$bdd->query("SELECT * from Cat_Pro");


while($donnees=$reponse->fetch()){ ?>

<option value="<?= $donnees['idCat_Pro'] ?>"><?= $donnees['Nom_Cat_Pro']  ?></option>

<?php
    } 
?>
</select> </div>

 <div class="form-group">
<label  class="control-label" for="composition">Composition :</label>
             
            <textarea name="composition" class="form-control" id="composition" type="text" placeholder="Composition du produit" required="required"></textarea>
         </div>

 <div class="form-group">
         <label  class="control-label" for="utilisation">Utilisation :</label>
            <textarea  name="utilisation" class="form-control" id="utilisation" type="text" placeholder="Utilisation du produit" required="required"></textarea>  
         </div>

 <div class="form-group">
         <label  class="control-label" for="desc_produit">Description du produit à enregistrer :</label>
            <textarea name="desc_produit" class="form-control" id="desc_produit" placeholder="Veuillez entrer la désignation du produit" required="required"></textarea>
         </div>

<div class="form-group">
            <label for="prix">Désigner le prix du produit mentionné ci-dessus:</label>
            <div class="input-prepend">
                 <span class="add-on" style="color: blue">€</span>
                    <input class="input-mini" class="form-control" type="text" value="100" name="prix" id="prix" required="required">
                            </div>
             </div>
<div class="form-group">
              <label  class="control-label" for="stock">Stock disponible :</label>
            <input  name="stock" class="form-control" id="stock" type="number" required="required">
         </div>

<div class="form-group">
   <label class="control-label" for="password" >Mot de passe :</label>
            <input name="password" class="form-control" id="password" type="password" placeholder="Entrer votre mot de passe" required="required">
            </div>

<div class="form-group">
 <button class="btn btn-primary" type="submit" name="enregistrer" style="color:white"> Enregister  </button></div>
                              
  </form>

</div>  <!-- div cols-lg-3 fermeture -->
<?php
}

?>

</div><!-- div container fluid fermeture -->

</div>  <!-- div enregistrer fermeture  -->

    

  <div class="tab-pane fade" id="info" role="tabpanel" arialabelledby="info-tab">

<br>

     
<div class="col-lg-5">
<img src="Images/gama.jpeg" class="img-rounded">
</div>


 <p class="text-center">
Chers professionnels MyDoctorHome vous offrent la possibilités d'<a href="#enregistrer">enregistrer vos produits en ligne</a>.<br>
Vos produits seront ainsi ajouter sur la liste de nos produits et des membres de notre plateforme pourront ainsi effectuer l'achat de vos produits.<br> Vous réaliserez ainsi la vente de vos produits en ligne via MyDoctorHome et plus encore vous pouvez ravitailler votre pharmacie 
en faisant vos <a href="pharmacie_proximite.php">commandes auprès des grossistes pharmaceutiques</a> depuis le confort de chez vous.</p><br><br><br>

<p>
Cher(e)s membres nos produits sont rangés de la manière suivantes:<br><br>

 
      <h5 style="color:green">MyDoctorHome <small>la médécine à la maison</small></h5>
 
<table class="table table-striped">
  <tr>
<th colspan="4" style="text-align:center;color: green"><h3>Catégoies de personnes</h3></th>
  </tr>

   <tr>
<td style="text-align:center"><h4>HOMMES</h4></td>
<td style="text-align:center"><h4>FEMMES</h4></td>
<td style="text-align:center"><h4>ENFANTS</h4></td>
<td style="text-align:center"><h4>AUTRES</h4></td>
  </tr>


  <tr>
<th colspan="4" style="text-align:center;color: green"><h3>Catégoies des produits</h3></th>
  </tr>

   <tr>
<td style="text-align:center"><h4>Allergie</h4></td>
<td style="text-align:center"><h4> Audio</h4></td>
<td style="text-align:center"><h4>Détox et vitalité</h4></td>
<td style="text-align:center"><h4>Premiers soins</h4></td>
  </tr>


</table>

</p><br>

                    </div> <!-- div info fermeture -->


                </div> <!-- div tab content fermeture  -->
            
            
         </div>  <!-- div container fluid fermeture -->

          </div>

<script src="js/jquery-latest.js"></script>
<script src="js/bootstrap.min.js"></script>

<script>
  $('#myTab a').click(function (e) {
    e.preventDefault();
    $(this).tab('show');
    })
</script>



<br><br><br><br><br>

 <!-- footer avant connexion-->
<?php include("pied.php"); ?>

  
  
</body>
</html>