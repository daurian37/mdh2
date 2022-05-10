<?php
include_once("auth/auth.php");


require("fonction.php");

include("header.php");
?>

<div class="container-fluid">
    <div class="headtext px-5">
        <h2 class="ui left floated header">MyDoctorHome <small>la médécine à la maison</small></h2>
        <div class="ui clearing divider"></div>
    </div><br><br>


    <ul class="nav nav-tabs" id="myTab" role="tablist">
 <li class="nav-item">
 <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home"
role="tab" aria-controls="home" aria-selected="true"><i class="fa fa-user"></i> Profil</span></a>
 </li>
 <li class="nav-item">
 <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile"
role="tab" aria-controls="profile" aria-selected="false"><i class="fa fa-bullhorn"></i> Publications</a>
 </li>
 <li class="nav-item">
 <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact"
role="tab" aria-controls="contact" aria-selected="false"><i class="fa fa-globe"></i> Amis</a>
 </li>
</ul>
<div class="tab-content" id="myTabContent">


 <div class="tab-pane fade show active" id="home" role="tabpanel" arialabelledby="home-tab">

<div class="row col-lg-12 my-5">

        <div class="col-lg-3 m-1">

            <div class="card">

              <img src="membres/avatar/<?php echo $donnees['Email'] ?>"  width="140"  class="text-center"/>

              <div class="card-body">
                <h5 class="card-title"><?= e($_SESSION['prenom'].' '.$_SESSION['nom']) ?></h5>
              </div>

              <ul class="list-group list-group-flush">
                <li class="list-group-item">
                  <form action="changer_photo.php" method="POST" enctype="multipart/form-data" >
                     
                        <div class="form-group">
                        <input type="file" name="avatar" id="avatar" required>
                        </div>
                    
                      <div class="form-group">
                    <button type="submit" name="modifier" class="btn custom-file contact_button"><i class="fa fa-camera"></i> Modifier</button>
                    </div>

                </form>
                  </li>
                <li class="list-group-item">
                  <strong><i class="fa fa-user"></i> <?= e($_SESSION['nom']) ?></strong>
                  <strong><?= e($_SESSION['prenom']) ?></strong>
                  </li>
                <li class="list-group-item">
                  <?php
                          try
                    {
                      $bdd= new PDO('mysql:host=localhost;dbname=mydoctorhome','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
                    }catch(Exception $e)
                    {
                      die('Erreur :' .$e->getMessage());
                    }

                              $req = $bdd->prepare('SELECT * from Abonne where idAbonne=?');
                              $req -> execute(array($_SESSION['id']));
                              $donnees=$req->fetch();
                              $req->closeCursor();
                    ?>
                        <strong><i class="fa fa-suitcase"></i> <?= e($donnees['Profession']) ?></strong>
                  </li>
                <li class="list-group-item">
                  <strong><i class="fa fa-calendar"></i> <?= e($_SESSION['datenaissance']) ?></strong>
                  </li>
                <li class="list-group-item">
                  <strong><?= e($_SESSION['sexe']) ?></strong>
                  </li>
                <li class="list-group-item">
                    <strong><i class="fa fa-signal"></i> <?= e($_SESSION['numero']) ?></strong>
                  </li>
              </ul>
              <div class="card-body">
                <i class="fa fa-envelope"></i>  <a href="mailto:<?= e($_SESSION['mail']) ?>"><?= e($_SESSION['mail'])?></a>
              </div>

                </div>
            </div>
    
<div class="col-lg-3 m-1 jumbotron">
    <h3>Changer votre mot de passe</h3>
         <p>En remplissant ces champs votre mot de passe sera mise à jour. </p> 
         <p>Veuillez entrer l'E-mail ainsi que le mot de passe avec le quel vous vous êtes inscrit sur MyDoctorHome afin que nous soyons rassuré qu'il sagit bien de vous.</p>

<!--gère l'affichage des messages d'erreurs si les instructions ne sont pas respectées-->
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
      
          <form method="post" action="changer_photo.php" autocomplete="off">


              <div class="form-group">
                <label for="mail_change">Adresse électronique :</label>
                <input type="email" class="form-control" name="mail_change" id="mail_change" >
              </div>

                <div class="form-group">
                <label for="ancienpassword">Ancien mot de passe :</label>
                <input type="password" class="form-control" name="ancienpassword" id="ancienpassword" >
              </div>

                <div class="form-group">
                <label for="nouveaupassword">Nouveau mot de passe :</label>
                <input type="password"  class="form-control" name="nouveaupassword" id="nouveaupassword" >
              </div>

                <div class="form-group">
                <label for="confirmerPassword_nouveau">Confirmer le mot de passe :</label>
                <input type="password" class="form-control" name="confirmerPassword_nouveau" id="confirmerPassword_nouveau" >
              </div>
          <div class="form-group">
              <input type="submit" class="btn btn-primary btn-small pullright form-control" name="modifier_login"  id="modifier_login" value="Changer de login">
            </div>
        </form>
         
    
  </div>
    

  <div class="col-lg-4 m-1 jumbotron">
            
            <h2>Modifier mon profil</h2>
             <p>
             La modification de ces champs entrainera une mise à jour de votre profil. <br>
             Les informations que vous entrerez seront vues par tous les membres.<br> 
             </p>           
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
            <form role="form" action="changer_photo.php" method="POST" autocomplete="off">

            <div class="form-group">
              <label for="nom">Nom</label>
              <input type="text" class="form-control" id="nom" name="nom" >
            </div>
            
             <div class="form-group">
              <label for="prenom">Prénom</label>
              <input type="text" class="form-control" id="prenom" name="prenom" >
            </div>

             <div class="form-group">
              <label for="datenaissance"></span> Date de naissance</label>
              <input type="date" class="form-control" id="datenaissance" name="datenaissance" >
            </div><br>

            <div class="form-group">
            <label for="sexe"> Sexe</label>
          <input  type="radio" name="sexe" id = "sexe"  value="M">M  <input  type="radio" name="sexe" id = "sexe" value="F">F
           </div><br>

            <div class="form-group">
              <label for="numero">Téléphone</label>
              <input type="text" class="form-control" name="numero" id="numero">
            </div>
            
            
                <div class="form-group">
                    <button class="btn btn-primary form-control" name="modifier_profil" type="submit" style="color:white"><i class="fa fa-pencil" value="modifier le profil"></i> Modifier le profil  </button>
                </div>

            </form>
            
    </div>   

  </div>  




 </div>







 <div class="tab-pane fade" id="profile" role="tabpanel" arialabelledby="profile-tab"> 
 
<br><br>
 
          <!--  <h2 class="ui horizontal divider header">
                Vos publications
            </h2><br> -->
<div class="container-fluid">

  <?php 

  try
{
    $bdd=new PDO('mysql:host=localhost;dbname=mydoctorhome','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}catch(Exception $e)
{
    die('Erreur :' .$e->getMessage());
}



$message=$bdd->prepare('SELECT * from publication where idAbonne=? order by Date_Pub desc');
$message->execute(array($donnees['idAbonne']));

while ($publications = $message->fetch()) { ?>


<?php
  $reponse=$bdd->prepare('SELECT * from Abonne where idAbonne=? ');
$reponse->execute(array($publications['idAbonne']));
$donnees=$reponse->fetch();

?>
<div style="background:green;height:100px;border-radius:5px;width: 592px;color: white">
 
 <a href="modifier_pub.php?id=<?= $publications['idPublication'] ?>"> <button type="submit" name="modifier_pub" id="modifier_pub"  style="float: right; width: 30px; height: 30px;" class="badge badge-pill badge-primary" title="Modifier la publication"><i class="fa fa-pencil"></i> </button> </a>
 
<form method="POST">

<button type="submit" name="suprimer_pub" id="suprimer_pub"  style="float: right; width: 30px; height: 30px;" class="badge badge-pill badge-danger" title="Suprimer la publication"><i class="fa fa-trash"></i></button>

</form>

<?php

if(isset($_POST["suprimer_pub"]))
{

$suprimer_like=$bdd->prepare('DELETE from like_pub where idPublication=?');
$suprimer_like->execute(array($publications['idPublication']));

$suprimer_com=$bdd->prepare('DELETE from commentaire_reseau where idPublication=?');
$suprimer_com->execute(array($publications['idPublication']));

$suprimer_pub=$bdd->prepare('DELETE from publication where idPublication=?');
$suprimer_pub->execute(array($publications['idPublication']));

}


?>




  <img src="membres/avatar/<?php echo $_SESSION['mail']; ?>"  width="40"   style="border-radius: 100%" /> <?= $donnees['Prenom']." ".$_SESSION['nom']?></a>


</div>

 <div style="width: 890px">
    <div class="col-lg-8 jumbotron">
<?php
if(!is_null($publications['Description_Pub'] )){
echo '<h5 class="offset-1">'.$publications['Description_Pub'].'<br><br></h5>';

}else if(!is_null($publications['Image'] )){
  ?>
<p class="offset-1">
<?php

  ?>
<img class="offset-1" src="membres/pub_image/<?php echo $publications['Titre_Pub']; ?>"  width="180"/> 
</p>  

<?php
}

echo '<b style="color:green" class="offset1">'.$publications['Date_Pub'].'<br><br></b>';
?>

<?php
$nombre=$bdd->prepare('SELECT count(*) from commentaire_reseau where idPublication=?');
$nombre->execute(array($publications['idPublication']));
$nombre=$nombre->fetch();

$likes=$bdd->prepare('SELECT * from like_pub where idPublication=?');
$likes->execute(array($publications['idPublication']));
$likes=$likes->rowCount();


?>
  <div class="p-0 mr-3   mt-3">
    
    
            <nav class="offset-9">
                <ul class="nav nav  ">
                   
                   <li> <a href="list_jaime.php?id=<?= $publications['idPublication'] ?>"><button type="submit"class="btn btn-primary btn-default px-5"> <i class="fa fa-thumbs-up"></i> <?= $likes ?></button></a></li>


                </ul>
            </nav>



</div>

<div class="p-0 mr-3   mt-3">
    
    
            <nav class="offset-9">
                <ul class="nav nav  ">
                   
                   <li> <a href="commentaire_acceuil.php?id=<?= $publications['idPublication'] ?>"><button type="submit"class="btn btn-success btn-default px-5"> <i class="fa fa-comment"></i> <?= $nombre['count(*)']  ?></button></a></li>

                </ul>
            </nav>



</div>
<hr>

  <?php
$nombre=$bdd->prepare('SELECT count(*) from commentaire_reseau where idPublication=?');
$nombre->execute(array($publications['idPublication']));
$nombre=$nombre->fetch();

$likes=$bdd->prepare('SELECT * from like_pub where idPublication=?');
$likes->execute(array($publications['idPublication']));
$likes=$likes->rowCount();




?>
     

       <div class="offset-1"> 

       <a href="action.php?t=1&id=<?= $publications['idPublication'] ?>"> <button class="btn-primary" title="aimer" ><i class="fa fa-thumbs-up"></i> J'aime (<?= $likes ?>)</button></a>
       <!-- <a href="action.php?t=2&id=<?= $publications['id'] ?>"> <button class="btn-primary" title="aimer" ><i class="fa fa-thumbs-down"></i> J'aime pas (<?= $dislikes ?>)</button></a> -->

        <a href="commentaire_acceuil.php?id=<?= $publications['idPublication'] ?>"><button class="btn-success" title="commenter" ><i class="fa fa-comment"></i> Commenter</button></a> 

        <a href="partager_publication.php?id=<?= $publications['idPublication'] ?>"><button class="btn-primary" title="partager" ><i class="fa fa-share-alt"></i> Partager</button></a>

       </div>
  </div>
    </div>

        <?php
}
        ?>

</div>

        <!--conditions generales-->
<div class="container-fluid py-3">
        
            <h4 class="ui horizontal divider header">
                Conditions générales et politiques de confidentialité
            </h4>
            
        <p>
        MyDoctorHome est une communauté de professionnels et des particuliers.<br><br>

        Vous vous engagez à :<br><br>
        respecter toutes les lois applicables, y compris, de manière non limitative, les lois en matière de protection de la vie privée, les lois relatives aux droits de propriété intellectuelle, les lois relatives aux e-mails non sollicités, les lois relatives au contrôle des exportations, les lois fiscales et les exigences réglementaires ;
        nous communiquer des informations exactes et à les mettre à jour ;
        utiliser votre nom réel sur votre profil ;
        utiliser les Services de façon professionnelle.
        </p>

      
</div>


<!--partie suppression du compte-->
<div class="container-fluid py-3">
                <h4 class="ui horizontal divider header">
                  Supprimer son Compte
                </h4> 

             <p class="text-center">Veuillez entrer l'E-mail ainsi que le mot de passe avec le quel vous vous êtes inscrit sur MyDoctorHome afin que nous soyons rassuré qu'il sagit bien de vous.</p>


              <form method="POST" autocomplete="off" action="suprimer_compte.php" >
<input type="email"  name="mail_sup" id = "mail_sup" required="required" class="form-control mb-2 mr-sm-2" placeholder="Entrez votre E-mail">
                <input type="password"  name="password_sup" id = "password_sup" required="required" class="form-control mb-2 mr-sm-2" placeholder="Entrez votre login">

<button class="btn btn-primary mb-2 btn-danger" name="suprimer" type="submit" style="color:white"><i class="fa fa-trash" ></i>  Suprimer mon compte </button>


</form>
                
</div>

        
             <p>    Avertissement:   
                 <dt>La suppression de votre compte va:</dt>
             <ul class="ui list">
                 <li><dd><b>Supprimer votre compte MyDoctorHome</b></dd></li>
                 <li><dd><b>Effacer l'historique des messages</b></dd></li>
                 <li><dd><b>Vous supprimer de tout vos groupes MyDoctorHome</b></dd></li>
             </ul>
             </p>
 

     </div> 



 <div class="tab-pane fade" id="contact" role="tabpanel" arialabelledby="contact-tab">


<?php

try{
      $bdd=new PDO('mysql:host=localhost;dbname=mydoctorhome','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

  }catch(Exception $e){

      die('Erreur :' .$e->getMessage());

  }

$amis=$bdd->query('SELECT * from amis');
$amis=$amis->fetch();

$select=$bdd->prepare("SELECT * from Abonne where idAbonne=? OR idAbonne=? ");
$select->execute(array($amis['user_id1'],$amis['user_id2']));
$user=$select->fetch();


 $query=$bdd->prepare("SELECT * from amis where user_id1 = ? OR user_id2 = ? ");
$query->execute(array($_SESSION['id'],$_SESSION['id']));
$datas=$query->fetchAll();

$user_check[] =$_SESSION['id'];

?>
<div class="col-lg-5" style="color:green">
        <form method="POST" autocomplete="off">

    

     <br>
        <h3>Vos amis : <span>
          <?php
          $nbr=$bdd->prepare('SELECT count(*) from amis where statut=? and  user_id2=?');
          $nbr->execute(array(0,$_SESSION['id']));
          $nbre=$nbr->fetch();

          echo $nbre['count(*)'];
?>
        </span> </h3><br>
<?php

for ($i=0; $i <sizeof($datas) ; $i++) { 
  
  if ($datas[$i]['user_id1']==$_SESSION['id']) {

   $select=$bdd->prepare("SELECT * from Abonne where idAbonne=?");
$select->execute(array($datas[$i]['user_id2']));
$user2=$select->fetch(); 
?>

<img src="membres/avatar/<?php echo $user2['Email']; ?>"  width="40" style="border-radius: 100%" />
 <a href="info_user.php?id=<?php echo $user2['idAbonne']; ?>">
<?php
echo $user2['Nom'].'  '.$user2['Prenom'].  "<br><button class='btn-danger offset-1'><a style='color:white'href='action_amis.php?action=delete&id=".$datas[$i]['id']  . "'>Supprimer de ma liste d'amis</a></button>";

?></a>

<?php
  $user_check[]=$datas[$i]['user_id2'];


if ($datas[$i]['statut']==true) {
  
  echo "(en attente d'être accepté) ";
}

  }else{

if ($datas[$i]['statut']==false) {

   $select=$bdd->prepare("SELECT * from Abonne where idAbonne=?");
$select->execute(array($datas[$i]['user_id1']));
$user1=$select->fetch(); 
  ?>
<img src="membres/avatar/<?php echo $user1['Email']; ?>"  width="40" style="border-radius: 100%" />
 <a href="info_user.php?id=<?php echo $user1['idAbonne']; ?>">
<?php
  echo $user1['Nom'].'  '.$user1['Prenom']."<br><button  class='btn-danger offset-1'><a style='color:white' href='action_amis.php?action=delete&id=".$datas[$i]['id']  . "'>Supprimer de ma liste d'amis</a></button><br>"  ;

  $user_check[]=$datas[$i]['user_id1'];
}


  }
      echo "<br> ";
}

?>
</a>

</div>

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

 </div>




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




    <?php  include("pied.php");  ?>







	</body>
</html>