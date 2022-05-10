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
    </div><br><br>




<?php


if(isset($_GET['id']) AND !empty($_GET['id'])){

$getid=htmlspecialchars($_GET['id']); ?>

<table border="1" class="table table-striped" >


  <tr>
    <th style="background:green;color:white">Nom du produit</th>
     <th style="background:green;color:white">Prix</th>
      <th style="background:green;color:white">Quantité initiale</th>
      <th style="background:green;color:white">Quantité disponible</th>
      <th style="background:green;color:white">Quantité vendue(s)</th>
  </tr>


<?php

try
{
  $bdd= new PDO('mysql:host=localhost;dbname=mydoctorhome','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}catch(Exception $e)
{
  die('Erreur :' .$e->getMessage());
}

$req=$bdd->prepare('SELECT * from produit where  idAbonne=? and idCat_Pro=?');

$req->execute(array($_SESSION['id'],$getid));


while($donnees=$req->fetch()){  

?>     


<tr>


  
  <td >


<a href="info_produit_enregistrer.php?id=<?php echo $donnees['idAbonne']; ?>">
                        
<?php

  
     echo ' <p>'.htmlspecialchars($donnees['Nom_Pro']).'</p>';


     ?>
</a>
   </td>


  <td >
          
<?php

  
     echo '<p>'.htmlspecialchars($donnees['Prix_Pro']).' £uros</p>';


     ?>


  </td>

  <td>
              
<?php

  
     echo '<p>'.htmlspecialchars($donnees['Qte_Pro']).' produit(s)</p>';

     ?>   


  </td>

  <td>
         
<?php

  
     echo '<p>'.htmlspecialchars($donnees['Qte_Pro']).' produit(s) disponible(s)</p>';



     ?>


  </td>

  <td>
    <?php
            


  $vendue=htmlspecialchars($donnees['Qte_Pro'])-htmlspecialchars($donnees['Qte_Pro']);
     echo '<p>'.htmlspecialchars($vendue).' produit(s)</p>';



?>



  </td>


</tr>

  <?php
}


     ?>

</table>

<?php
}

     ?>


    </div>



<!-- js -->
<script src="js/jquery-latest.js"></script>
<script src="js/bootstrap.min.js"></script>

<br><br><br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

	<?php
include("pied.php");

	?>
</body>
</html>
