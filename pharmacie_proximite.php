<?php

include_once("auth/auth.php");

?>

<?php
include("header.php");

try{
      $bdd=new PDO('mysql:host=localhost;dbname=mydoctorhome','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

  }catch(Exception $e){

      die('Erreur :' .$e->getMessage());

  }


    //systeme de pagination
  $nbpro = $bdd->query("SELECT count(*) as nbpro from pharmacie");

  foreach($nbpro as $nb){
    
    $nbpro = $nb['nbpro'];
  }


  $cpg = 1;//indice de la page actuelle
  $nbpage = 10; //le nombre d element a afficher par page

  $pgnbr = ceil($nbpro/$nbpage);//Le nombre totale de page a generer

  //$req ="SELECT * from produits LIMIT ".(($cpg-1)*$nbpage).",$nbpage"; 
  //echo $pgnbr;


  //controle de la valeur du lien
  if(isset($_GET['p']) && $_GET['p'] >= 0 && $_GET['p'] <= $pgnbr){
    
    $cpg =  $_GET['p'];

  }
  else{

    $cpg = 1;

  }

  $req ="SELECT * from pharmacie LIMIT ".(($cpg-1)*$nbpage).",$nbpage"; 

?>


    <div class="container-fluid">
    
    <div class="headtext px-5">
        <h2 class="ui left floated header">MyDoctorHome <small>la médécine à la maison</small></h2>
        <div class="ui clearing divider"></div>
    </div>
        
    <div class="row col-lg-10 offset-1 jumbotron my-5">
            <div class="col-lg-6">
                <h2>Pharmacie à proximité</h2>
                <p>Fini les temps d'attente dans les pharmacies
                    Avec MyDoctorHome commander vos produits dans la pharmacie la plus proche et faites vous livrer chez vous
                    Bien plus encore, commander des produits médicals en France et à l'étranger
                </p>
            </div>
         
            <div class="col-lg-6">
                <div>
                <img src="Images/dc5.jpg" class="imgC">
                </div>
            </div>
              
    </div>
    <div class="row col-lg-10 offset-1">
       <p class="">Chers particuliers, fini les temps d'attente dans les pharmacies
            Avec MyDoctorHome faites votre commande en ligne, commander vos produits dans la pharmacie la plus proche et faites vous livrer chez vous
            Bien plus encore. Vous n'avez qu'à effectuer votre recherche en entrant le nom de la ville dans la quelle vous vous trouvez ainsi s'affichera toutes les pharmacies de la ville.<br>
            Merci de bien vouloir choisir la pharmacie la plus proche de chez vous.<br><br>

        </p>
    </div>


     
           <!--Sous menu nos produits-->
        
    <div class="row col-lg-10 offset-1 jumbotron">
        <div class="col-lg-12 text-center p-5">
        <p style="text-align: center;color: blue">Cher(e)s membres vous trouverez ici toutes les pharmacies de livraison disponible sur la plateforme.</p>
        </div>
        <div class="col-lg-6">
        <img src="Images/dc5.jpg" class="imgC">
        </div>


        <div class="col-lg-6" style="color:green">
        <form method="POST" autocomplete="off">

          <div class="container">

       <div class="form-group mb-2">
        <p>Entrer votre recherche en remplissant ce champs : </p>
        <input type="search"   class="form-control text-center" name="nom_ville" id="nom_ville" placeholder="Entrer votre recherche" required="required">
       </div>

      <div id="display-results">
        
      </div>
        </form>
        </div>
        </div>

        </div>

<h2 style="color:green" class="offset-1" id="pg">Nos pharmacies </h2><br>


<?php

try
{
    $bdd=new PDO('mysql:host=localhost;dbname=mydoctorhome','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}catch(Exception $e)
{
    die('Erreur :' .$e->getMessage());
}

        $req = $bdd->query($req);
              foreach($req as $donne ){

                ?>


<!-- <div  style="width: 500px">  -->
    <form class="col-lg-3 offset-1 jumbotron" method="POST">
  <b>  <a href="commande.php?id_pharmacie=<?php echo $donne['id_pharmacie']; ?>">
       <?php 

      
     echo '<div class="pub">'.htmlspecialchars($donne['nom_pharmacie']) .'  '.htmlspecialchars($donne['ville_pharmacie']).'<br>'.'</div><br>'; 
    


     ?>
   </b></a>
   </form>
   <!--  </div> -->
    
<?php
        }

   $reponse->closeCursor();

?>

             
                    </div>
                            </div>


<?php
      

   $reponse->closeCursor();
?>

<div class="container-fluid" align="center">

  <?php

              for($i=1; $i<=$pgnbr;$i++){ 

                if($i==$cpg){
                  echo  "<a style='padding-top: 2px;margin-top: 15px; margin-right : 5px ; width: 3rem; height: 2rem' class='badge badge-secondary produit'> $i</a>";
                }
                else{

                  echo  "<a style='margin-top: 15px; margin-right : 5px ; width: 3rem; height: 2rem' class='badge badge-success produit' href='pharmacie_proximite.php?p=$i #pg'> $i</a>";
                }  

              }

        ?>
</div>

 <!--FIN Affichages des produits-->
               
           
            



<!-- js -->
<script scr="http://code.jquery.com/jquery.js"></script>
<script src="js/bootstrap.min.js"></script> 
<script src="js/jquery-latest.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/main.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>


<script src="js/carte.js"></script> 
<script src="js/app.js"></script>
<!--ce sont les michibichi de bootstrap je ne sais quoi dire la dessus...pfff... lol-->

<script>
  $('#myTab a').click(function (e) {             
    e.preventDefault();
    $(this).tab('show');
    })
</script>



<br><br><br><br>


<?php
include("pied.php");
?>

</body>
</html>