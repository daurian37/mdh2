<?php
include_once("auth/auth.php");
require("fonction.php");

include("header.php");

?>


<?php

                                $id=$_GET['id'];
                                $reponse=$bdd->query("SELECT * from produit where idProduit='$id' ");
                                $donnees=$reponse->fetch();

                              ?>


 <div class="container-fluid">
    
    <div class="headtext px-5">
        <h2 class="ui left floated header">MyDoctorHome <small>la médécine à la maison</small></h2>
        <div class="ui clearing divider"></div>
    </div><br><br><br>

<div class="container-fluid">


<div class="span2">

	
<img src="membres/image/<?php echo $donnees['image_Pro']; ?>"  class="img-rounded" width="400" /> <br/><br/>
<form method="POST">
  <div class="form-group">
<label for="quantite"><b>Quantité :</b></label>
<input type="number" class="form-control col-lg-3" name="quantite" id="quantite">
</div>
<div class="form-group">
<button type="submit" class="btn btn-success" name="valider"> valider </button>
 </div>
</form>

            
          

<?php
if(!empty($_POST['quantite'])){

  echo "vous avez selectionné ".$_POST['quantite']." produit(s)";

if($_POST['quantite']>=1){

$Stock_restant=$donnees['Qte_Pro']-$_POST['quantite'];


if(isset($_GET['id']) AND !empty($_GET['id'])){

$getid=htmlspecialchars($_GET['id']);

 try
{
  $bdd= new PDO('mysql:host=localhost;dbname=mydoctorhome','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}catch(Exception $e)
{
  die('Erreur :' .$e->getMessage());
}

$req=$bdd->prepare('SELECT * from produit where idProduit=?');
$req->execute(array($getid));
$req=$req->fetch();


$ins=$bdd->prepare('INSERT into qte (qte,id_produit) VALUES (?,?)');
$ins->execute(array($_POST['quantite'],$getid));

$insertion=$bdd->prepare('INSERT into stock_restant (stock_restant,id_produit) VALUES (?,?)');
$insertion->execute(array($Stock_restant,$getid));


  }

 }else
           {

            

            echo '<div class="alert alert-danger col-lg-3" role="alert">la quantité de produit à acheter doit être superieur ou égale à 1 produit. veuillez augmenter la quantité à acheter </div>';
           }
         }
?>






<br>

<?php
if($donnees['Qte_Pro']!=0){
?>
   <a href="panier.php?id=<?= $donnees['idProduit'] ?>" ><button type="submit" class="btn btn-success">Ajouter au panier</button></a>
<?php
}else

  echo '<div class="alert alert-danger col-lg-3" role="alert">stock épuisé</div>';
?>
  
  <div >
    

   </div></div> <br>     

         
            <h1><strong></i> <?= e($donnees['Nom_Pro']) ?></strong><br/><br/></h1>
             <strong><?= e($donnees['Description_Pro']) ?></strong><br/><br/>

             <?php   

                  if($donnees['Qte_Pro']>0){ ?>
             <strong><?= e('Stock disponible:  '.$donnees['Qte_Pro']) ?></strong><br/><br/>

          <?php 
              }else
              {
                echo '<b>stock épuisé</b>';
              }
              

             ?>
          
            
            
                <ul class="nav nav" id="myTab">
                    <li class="active"><a href="#description"> Description</a></li>
                    <li><a href="#utilisation">Utilisation</a></li>
                    <li><a href="#compostion">Composition</a></li>
                </ul>
                
                <div class="tab-content">
                    <div class="tab-pane active" id="description">

                      <?php

                                $id=$_GET['id'];
                                $reponse=$bdd->query("SELECT * from produit where idProduit='$id' ");
                                $donnees=$reponse->fetch();


    try
{
  /*  connexion a la base de donnée   */


  $bdd= new PDO('mysql:host=localhost;dbname=mydoctorhome','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}catch(Exception $e)
{
  die('Erreur :' .$e->getMessage());
}

$reponse=$bdd->prepare("SELECT * from Abonne where idAbonne=?");
$reponse->execute(array($donnees['idAbonne']));
$reponse=$reponse->fetch();
               
                              ?><br>
                      
<strong><?= e('Titre:  '.$donnees['Nom_Pro']) ?></strong><br/><br/>
    <strong><?= e('Description:  '.$donnees['Description_Pro']) ?></strong><br/><br/>
     <strong><?= e('Prix:  '.$donnees['Prix_Pro'].' £ ') ?></strong><br/><br/>
        <b>Publié par:</b> <a href="mailto:<?= e($reponse['Email']) ?>">

    <?php 

echo $reponse['Nom'].'  '.$reponse['Prenom'];

  ?></a>




                    </div>
                    <div class="tab-pane" id="utilisation"><br>
                     
<strong><?= e('utilisation du produit :  '.$donnees['Utilisation_Pro']) ?></strong><br/><br/>
   


                    </div>
                    <div class="tab-pane" id="compostion"><br>
                        
 
 <strong><?= e('Composition du produit:  '.$donnees['Composition_Pro']) ?></strong><br/><br/>

                    </div>
                </div>
       
  

<script src="js/jquery-latest.js"></script>
<script src="js/bootstrap.min.js"></script>

<script>
  $('#myTab a').click(function (e) {
    e.preventDefault();
    $(this).tab('show');
    })
</script>




</div>
</div>
</div></div><br><br>



<?php

include("pied.php");
?>