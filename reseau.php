<?php
include_once("auth/auth.php");
require('fonction.php'); 
include('header.php');
 ?>

<div class="container-fluid">
    
    <div class="headtext px-5">
        <h2 class="ui left floated header">MyDoctorHome <small>la médécine à la maison</small></h2>
        <div class="ui clearing divider"></div>
    </div> 
    <br>

    
    	<div class="row col-lg-10 offset-1 jumbotron">
            <div class="col-lg-6">
                <h2 class="titrage">Réseau</h2>
                <p btext>MyDoctorHome c'est aussi un réseau d'échange et de partage
                facilitant ainsi l'échange entre professionnels de santé et particuliers.<br>
                Grâce à son réseau et son forum, vous pouvez consulter les publications et conseils des professionnels de santé mais aussi discuter entre amis.
                Echangez vos connaissances afin de changer le monde.
                </p>
            </div>
         
            <div class="col-lg-5">
                <div>
                <img src="Images/dc1.jpg" class="imgC">
                </div>
            </div>
              
        </div>
        
<div class="row col-lg-3 offset-1 p-0">

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
</div>

<div class="col-lg-5" style="color:green">
        <form method="POST" autocomplete="off">

          <div class="container">

       <div class="form-group">
        <p>Entrer votre recherche en remplissant ce champs : </p>
        <input type="search"   class="form-control form-control-lg" name="nom_membre" id="nom_membre" placeholder="Entrer votre recherche" required="required">
       </div>

      <div id="display-results">
        
      </div>
        </form>
        </div>
</div>
    </div>


<div class="container-fluid">
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

          <div class="container">

       <div class="form-group">
        <h3>Vos amis : <!--span>
          <?php
          $nbr=$bdd->prepare('SELECT count(*) from amis where statut=? and  user_id2=?');
          $nbr->execute(array(0,$_SESSION['id']));
          $nbre=$nbr->fetch();

          echo $nbre['count(*)'];
?>
        </span--> </h3><br>
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


<br><br>





<h3>Demande d'amis :<!--span>
          <?php
          $nbr=$bdd->prepare('SELECT count(*) from amis where user_id2=? and statut=?');
          $nbr->execute(array($_SESSION['id'],1));
          $nbre=$nbr->fetch();

          echo $nbre['count(*)'];
?>
        </span--></h3><br>

<?php

for ($i=0; $i <sizeof($datas) ; $i++) { 

if ($datas[$i]['statut']==true && $datas[$i]['user_id2']==$_SESSION['id'] ) {


   $select=$bdd->prepare("SELECT * from Abonne where idAbonne=?");
$select->execute(array($datas[$i]['user_id1']));
$user1=$select->fetch(); 
  
  ?>
<img src="membres/avatar/<?php echo $user1['Email']; ?>"  width="40" style="border-radius: 100%" />
 <a href="info_user.php?id=<?php echo $user1['idAbonne']; ?>">
<?php
  echo $user1['Nom'].'  '.$user1['Prenom']."<br><button style='color:white' class='btn-primary offset-1'><a style='color:white' href='action_amis.php?action=accept&id=".$datas[$i]['id']  . "  '>Accepté la demande</a></button>  <button  class='btn-danger'><a style='color:white' href='action_amis.php?action=delete&id=".$datas[$i]['id']  . "'>Refusé la demande</a></button><br><br>";

  $user_check[]=$datas[$i]['user_id1'];
}
}

?>
</a>


<br><br>
<h3>Connaissez vous ?</h3><br>

<?php
$query=$bdd->query("SELECT * from Abonne");
$data=$query->fetchAll();

 for ($i=0; $i <sizeof($data) ; $i++) { 
  
  if (!in_array($data[$i]['idAbonne'], $user_check)) {
    ?>
<img src="membres/avatar/<?php echo $data[$i]['Email']; ?>"  width="40" style="border-radius: 100%" />
 <a href="info_user.php?id=<?php echo $data[$i]['idAbonne']; ?>">
<?php
    echo $data[$i]['Nom'].'  '.  $data[$i]['Prenom']. " <br><button style='color:white' class='btn-success offset-1'>  <a style='color:white' href='action_amis.php?action=add&id=".$data[$i]['idAbonne']  . "'>Envoyer une demande</a></button><br>";
  }
 }
?>
</a>
</div>
</div></div></div>
<br><br><br>






<script src="js/jquery-latest.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/reseau.js"></script>


    <?php
include("pied.php");

    ?>
</body>
</html>