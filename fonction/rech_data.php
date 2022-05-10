<?php

    include_once('./conn.php');
   

    if(isset($_GET['re'])){

        $re = $_GET['re'];
        $chaine = "SELECT * from produit where Nom_Pro LIKE '%$re%'";

        $req = $bdd->query($chaine);
        $cpt = 0;
        foreach( $req as $donne ){

            
            ?>
                
                <div class="card " style="width: 16rem; margin-top: 20px; margin-left: 10px; ">
                
                <!-- Vous allez changer la taille des images ici -->
                <div align="center">
                    <img class="card-img-top" style="width: 13rem; height: 9rem" src="./membres/image/<?=$donne['image_Pro']?>.jpg" alt="image produit">
                </div>
                

                <div class="card-body">
                    <h5 class="card-title"><?=$donne['Nom_Pro']?></h5>

                    <h2><?=$donne['Prix_Pro']?> € </h2>

                    <p class="card-text"><?=$donne['Description_Pro']?></p>
                        <a href="info_produit.php?id=<?= $donne['idProduit'] ?>" class="btn btn-success">Info produit</a>
                    
                </div>
                <div class="card-footer text-muted">
                    Stock : <?=$donne['Qte_Pro']?>
                </div>
                </div>
                
            <?php 

            $cpt++;
        }

        if($cpt <= 0){

            echo "<p class='jumbotron offset-5' align='center' >"."Aucun resultat trouvé"."<p>";
        }

    }
    else{



    }

    


?>