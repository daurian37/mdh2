<?php 
include_once("auth/auth.php");

if (isset($_POST['envoie_message'])) {

if(isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name'])){

  
  $tailleMax = 2097152;
  $extensionsValides = array('jpeg','jpg','png','pdf','docx');

  if($_FILES['avatar']['size']<= $tailleMax){

    $extensionsUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));

    if(in_array($extensionsUpload, $extensionsValides)){

      $chemin = "membres/message/".$_POST['message'].".".$extensionsUpload;

      $resultat = move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin);

      if($resultat){

        try
{
  $bdd= new PDO('mysql:host=localhost;dbname=mydoctorhome','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}catch(Exception $e)
{
  die('Erreur :' .$e->getMessage());
}



          $req = $bdd->prepare('INSERT into chat_image(image) values(?)');
          $req -> execute(array(implode($_FILES['avatar'], "")));
          $req->closeCursor();

            
      }
      else
      {
        $errors[]="Erreur durant l'importation de votre photo de profil";
      }

    }
    else
    {

      $errors[]="Votre photo de profil ne doit être au format jpg";
    }
}
    else
    {
      $errors[]="Votre photo de profil ne doit pas dépasser 2 Mo";
    }
  
}
  
}


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
$donnees = $req->fetch();


if(isset($donnees['idAbonne']) AND !empty($donnees['idAbonne'])){

if(isset($_POST['envoie_message'])){

if(isset($_POST['destinataire'],$_POST['message']) AND !empty($_POST['destinataire']) AND !empty($_POST['message'])){

    $destinataire=htmlspecialchars($_POST['destinataire']);
     $message=htmlspecialchars($_POST['message']);
     

$req_id=$bdd->prepare('SELECT * from Abonne where Email=?');
$req_id->execute(array($destinataire));

$dest_exist=$req_id->rowCount();

if($dest_exist==1){

    $id_destinataire = $req_id->fetch();
$id_destinataire= $id_destinataire['idAbonne'];  //preciser que c'est l'id du array que l'on veut recuperer

$ins= $bdd->prepare('INSERT INTO chat_message(to_user_id,from_user_id,chat_message,image,timestamp) VALUES (?,?,?,?,NOW())');


$error="Votre commande à bien été envoyé.";

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
$donnees = $req->fetch();

$requ=$bdd->query('SELECT * from chat_image');
$don = $requ->fetch();


$ins->execute(array($id_destinataire,$donnees['idAbonne'],$message,$don['Image']));
$del=$bdd->query('TRUNCATE TABLE chat_image');


}

        }
}

$destinataires=$bdd->query("SELECT Email from Abonne ORDER BY Email");

if(isset($_GET['r']) AND !empty($_GET['r'])){

  $r= htmlspecialchars($_GET['r']);
}


if(isset($_GET['o']) AND !empty($_GET['o'])){

  $o= urldecode($_GET['o']);
  $o= htmlspecialchars($_GET['o']);

if(substr($o, 0,3) != 'RE:'){

   $o="RE:".$o;

}


}



include("header.php");

 ?>

 <div class="container-fluid">
    
    <div class="headtext px-5">
        <h2 class="ui left floated header">MyDoctorHome <small>la médécine à la maison</small></h2>
        <div class="ui clearing divider"></div>
    </div><br><br>
        

           
            <div class="row">
                <div class="span6 offset-1">
                    
                     <div>
                         
                             <img class="img-responsive" src="Images/Doctor_en_ligne.png" alt="product_1" />
                        
                         <h3>


                             <h3 ><?php

                                $id=$_GET['id_pharmacie'];
                                $reponse=$bdd->query("SELECT * from pharmacie where id_pharmacie='$id' ");
                                $donnees=$reponse->fetch();

                   echo '<b> BONJOUR'.'   '. $_SESSION['prenom'].'</b> ';?>BIENVENUE CHEZ<br/> <i style="color: green"><?php echo  $donnees['nom_pharmacie']; 


                              ?></i></h3>
                         </h3>
                <address>
               <strong>
                    <br>
                069H, CITE SCHELTER
                <br>
                France, <?php echo $donnees['ville_pharmacie']; ?><br>
                <?php echo $donnees['mail_pharmacie']; ?>
                <abbr title="téléphone">Tél.</abbr> 069176545<br/>
                code postal: 50100
            </address>
               </strong><br>

              
                </div>
               
                     </div> 

       
 <div class="col-lg-7 offset-1">

		
        	<h3>Entrer votre commande</h3>
       
       
<form method="POST"  enctype="multipart/form-data">

<div class="control-group">
<label class="control-label" for="message"><b>laisser un message à la pharmacie :</b></label><br>

<p style="color:green"><b>Cher(e)s membres veuillez s'il vous plaît mentionner l'adresse de livraison ainsi que la ville dans la quelle se situe l'adresse de livraison, afin de nous aider à faciliter la livraison de vos produits. Merci<b></p><br>

<div class="controls">
    <div class="form-group">

    <textarea class="form-control form-control-lg" placeholder="votre message" name="message" id="message" rows="10"></textarea>

    </div>
  </div>
</div> 
<div class="form-group">
<input type="file" name="avatar" id = "avatar" required="required">
</div>
     <div class="control-group">

  
  <div class="controls">
    <div class="form-group">
      <input class="span-3" id="destinataire" name="destinataire" type="hidden" <?php if(isset( $donnees['mail_pharmacie'])){echo 'value="'. $donnees['mail_pharmacie'].'"'; }    ?>  required placeholder="nom@gmail.com" required="required">
    </div>
  </div>
</div>  


<?php if(isset($error)){ echo '<span style="color:green">'.$error.'</span>'; }  ?><br><br>
 <div class="form-group">
    <button class="btn-success" name="envoie_message" id="envoie_message"><i class="fa fa-shopping-cart"></i> Passer la commande</button>
</div>
 
</form><br><br>
</div>
</div>
  </div>


 <script src="js/jquery-latest.js"></script>
<script src="js/bootstrap.min.js"></script>



       <?php include("pied.php"); ?>

   </body>
    </html>

<?php
}

?>