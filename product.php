s
  <?php
include_once("auth/auth.php"); 


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
    </div>

<div class="container-fluid">


<h2 style="color: green">Nos services pharmaceutiques</h2><br>

<?php


if(isset($_GET['id']) AND !empty($_GET['id'])){

$getid=htmlspecialchars($_GET['id']);

?>
<table class="table table-striped" border="2">
  <tr>
<th style="background:green;color:white">Produits de la catégorie
<?php 

  try
{
    $bdd=new PDO('mysql:host=localhost;dbname=mydoctorhome','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}catch(Exception $e)
{
    die('Erreur :' .$e->getMessage());
}

$message=$bdd->prepare('SELECT * from Cat_Pro where idCat_Pro=?');
$message->execute(array($getid));
$message=$message->fetch();

echo $message['Nom_Cat_Pro'];

try
{
    $bdd=new PDO('mysql:host=localhost;dbname=mydoctorhome','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}catch(Exception $e)
{
    die('Erreur :' .$e->getMessage());
}
  $nombre=$bdd->prepare('SELECT count(*) from produit where idCat_Pro=? ');

$req=$bdd->prepare('SELECT * from Cat_Pro where idCat_Pro=?');
$req->execute(array($getid));
$req=$req->fetch();

$nombre->execute(array($req['idCat_Pro']));

$nombre=$nombre->fetch();  ?>

<b><span class="badge badge-light"><?= $nombre['count(*)']; ?></span></b>



 </th>

 <th style="background:green;color:white"> image du produit</th>
<th style="background:green;color:white"> Prix</th>
<th style="background:green;color:white"> Description</th>

  </tr>

  <?php 

  try
{
    $bdd=new PDO('mysql:host=localhost;dbname=mydoctorhome','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}catch(Exception $e)
{
    die('Erreur :' .$e->getMessage());
}

$message=$bdd->prepare('SELECT * from produit where idCat_Pro=?');

$req=$bdd->prepare('SELECT * from Cat_Pro where idCat_Pro=?');
$req->execute(array($getid));
$req=$req->fetch();

$message->execute(array($req['idCat_Pro']));



while ($publications = $message->fetch()) { ?>

   <tr>

<td>
<a href="info_produit.php?id=<?= $publications['idProduit']  ?>"><?= $publications['Nom_Pro'] ?></a>
</td>

<td style="text-align: center">


<img src="membres/image/<?php echo $publications['image_Pro']; ?>" width="100" class="img-rounded" /> <br/><br/>


</td>

<td>
  
<b><?= $publications['Prix_Pro'].' €' ?></b> <b>

</td>

<td>
  
<b><?= $publications['Description_Pro'] ?></b> <b>

</td>


  </tr>

<?php
}
  }
?>

</table>
</div>


<!-- js -->
<script src="js/jquery-latest.js"></script>
<script src="js/bootstrap.min.js"></script>

<br><br>

    <?php
include("pied.php");

    ?>
</body>
</html>