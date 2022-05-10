<?php

  include_once("auth/auth.php");
 include("header.php");

  try{
      $bdd=new PDO('mysql:host=localhost;dbname=mydoctorhome','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

  }catch(Exception $e){

      die('Erreur :' .$e->getMessage());

  }


    //systeme de pagination
  $nbpro = $bdd->query("SELECT count(*) as nbpro from produit");

  foreach($nbpro as $nb){
    
    $nbpro = $nb['nbpro'];
  }


  $cpg = 1;//indice de la page actuelle
  $nbpage = 4; //le nombre d element a afficher par page

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

  $req ="SELECT * from produit LIMIT ".(($cpg-1)*$nbpage).",$nbpage"; 

?>

<!--  lien temporaire bostrap 4-->
<link rel="stylesheet" href="./assets/bootstrap.css">

<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">


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
    </div>
    

<!-- ****************************************************************************************  -->

<div class="container-fluid" align="center">
         

          <!--@smeth-->
<!--Affichages des produits et filtre-->

<div class="container-fluid row" id="pg" >

      <!--partie filtre-->
      <div class="col-2 " style="margin-top: 20px;">

          <form class="" style="margin-right: 10px; ">
                <div class="form-group">
                  <label for="rech">Recherche</label>
                  <input type="search" class="form-control" id="rech" placeholder="saisir le produit">
                </div>
                <button type="button" class="btn btn-success" id="sub">recherche</button>
                
          </form>
       </div>

    
    <!--partie affichage produit-->
     <div class="col-10 ">
      <div class="row" id="resultat">
        <div class="row produit">            
           <?php  
              $req = $bdd->query($req);
              foreach($req as $donne ){

                ?>
            
                    <div class="card " style="width: 16rem; margin-top: 20px; margin-left: 10px; ">
                      
                    <!-- Vous allez changer la taille des images ici -->

                    <!--  ne gere que le format jpeg a revoir ce point     -->
                      <div align="center">
                         <img class="card-img-top" style="width: 13rem; height: 9rem" src="./membres/image/<?=$donne['image_Pro']?>.jpg" alt="image produit">
                      </div>
                      

                      <div class="card-body">
                        <h5 class="card-title"><?=$donne['Nom_Pro']?></h5>

                        <h2><?=$donne['Prix_Pro']?> € </h2>

                        <p class="card-text"><?=$donne['Description_Pro']?></p>
                        <a href="info_produit.php?id=<?= $donne['idProduit'] ?>" class="btn btn-success">Info produit</a>
<!-- 
                          <?php
                    if($donne['stock']!=0){
                          ?>

                        <a href="panier.php?id=<?= $donne['id'] ?>" class="btn btn-success">Ajouter au panier</a>

                        <?php
                        } ?> -->

                      </div>
                      <div class="card-footer text-muted">
                        Stock : <?=$donne['Qte_Pro']?>
                      </div>
                    </div>
                    
              <?php 
              }

            ?>
        </div>

      </div>
    </div>


</div>



        <!--Pagination @by smeth-->
        <?php

              for($i=1; $i<=$pgnbr;$i++){ 

                if($i==$cpg){
                  echo  "<a style='padding-top: 2px;margin-top: 15px; margin-right : 5px ; width: 3rem; height: 2rem' class='badge badge-secondary produit'> $i</a>";
                }
                else{

                  echo  "<a style='margin-top: 15px; margin-right : 5px ; width: 3rem; height: 2rem' class='badge badge-success produit' href='./all_product.php?p=$i #pg'> $i</a>";
                }  

              }

        ?>


 <!--FIN Affichages des produits-->



   </div>


 <script src="./assets/jquery.js"></script>
 <script src="js/jquery-latest.js"></script>
 <script src="js/bootstrap.min.js"></script>






<script>
  $('#myTab a').click(function (e) {
    e.preventDefault();
    $(this).tab('show');
    })

  $(function(){
      $.get("./req.php");


  });


//recherche intanrané by  @smeth
  $(function(){




// a chaque saisi du clavier
      $('#rech').keyup(function(){

          let val_saisi = $('#rech').val();

          $.ajax({

            type: 'GET',
            url: './fonction/rech_data.php',
            data: "re=" + encodeURIComponent(val_saisi),
            success: function(data){
              
                  if(val_saisi.length>0){

                  $('#resultat').html(data);
                  }
                        
               

            
            }
          });


      });

  });
</script>

<br><br><br><br>

 <!-- footer avant connexion-->
<?php include("pied.php"); ?>
