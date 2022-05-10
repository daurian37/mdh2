<?php 
include_once("auth/auth.php");
include("header.php");

 ?>


 <div class="container-fluid">
    
         <div class="headtext px-5">
        <h2 class="ui left floated header">MyDoctorHome <small>la médécine à la maison</small></h2>
        <div class="ui clearing divider"></div>
    </div> 
    <br><br><br>
<?php


if(isset($_GET['id']) AND !empty($_GET['id'])){



$getid=htmlspecialchars($_GET['id']);


try
{
  $bdd= new PDO('mysql:host=localhost;dbname=mydoctorhome','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}catch(Exception $e)
{
  die('Erreur :' .$e->getMessage());
}

$requete=$bdd->prepare('SELECT * from qte where id_produit=?');
$requete->execute(array($getid));
$requete=$requete->fetch();


$reponse=$bdd->prepare('SELECT * from stock_restant where id_produit=?');
$reponse->execute(array($getid));
$reponse=$reponse->fetch();
/*  enregistrement de l'utilisateur  */
$req=$bdd->prepare('SELECT * from produit where idProduit=?');
$req->execute(array($getid));
$req=$req->fetch();

$ins=$bdd->prepare('INSERT into panier (id_produit,categorie_produit,titre_produit,image,prix_produit,description_produit,idAbonne,stock,utilisation,composition,client,quantite) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)');
$ins->execute(array($getid,$req['idCat_Pro'],$req['Nom_Pro'],$req['image_Pro'],$req['Prix_Pro'],$req['Description_Pro'],$req['idAbonne'],$req['Qte_Pro'],$req['Utilisation_Pro'],$req['Composition_Pro'],$user['idAbonne'],$requete['qte']));

$remplace=$bdd->prepare('UPDATE panier set stock=? where id_produit=?');
$remplace->execute(array($reponse['stock_restant'],$getid));

$remplace=$bdd->prepare('UPDATE produit set Qte_Pro=? where idProduit=?');
$remplace->execute(array($reponse['stock_restant'],$getid));

$sup=$bdd->prepare('DELETE from qte where id_produit=?');
$sup->execute(array($getid));

$supression=$bdd->prepare('DELETE from stock_restant where id_produit=?');
$supression->execute(array($getid));

echo "Votre produit à bien été ajouté dans le panier veuillez consulter votre panier.<br>
Cliquez sur l'onglet 'Panier'.<br>
Cliquez sur l'onglet 'Pharmacie' pour ajouter un nouveau produit.";

}
            

?>

</div>
</div><br><br><br><br><br><br><br><br><br>

       <?php include("pied.php"); ?>

   </body>
    </html>