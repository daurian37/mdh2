
<!--debut ajout de daurian du 2/07/2020  -->

	<?php
  include('fonction.php');
	include('connexion_bd.php');

	session_start();


if (isset($_POST['valider'])) {

if(isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name'])){

  
  $tailleMax = 2097152;
  $extensionsValides = array('jpg');

  if($_FILES['avatar']['size']<= $tailleMax){

    $extensionsUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));

    if(in_array($extensionsUpload, $extensionsValides)){

      $chemin = "membres/messagerie/".$_SESSION['prenom'].".".$extensionsUpload;

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


	?>
<!Doctype html>
<head>
<title >my Doctorhome</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="css/dist/semantic.min.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" href="css/bootstrap-responsive.min.css">

<link rel="stylesheet" type="text/css" href="page_index.css" >

<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/font-awesome-4.7.0/css/font-awesome.css">
<link rel="stylesheet" href="css/bootstrap-responsive.css">


<script type="text/javascript" src="js/main.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
 <link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
 <link href="css/emojionearea.min.css" rel="stylesheet">
  <script type="text/javascript" src="js/emojionearea.min.js"></script>
       <script type="text/javascript" src="js/query.js"></script>
       <script type="text/javascript" src="js/jquery.form.js"></script>
       <script type="text/javascript" src="js/jquery-1.12.4.js"></script>
    <script>window.jQuery || document.write('<script src="../js/query.min.js"><\/script>')</script>
      <script src="js/bootstrap.min.js"></script>
       <script src="js/query.js"></script>
</head>


 <body>

    
<div class="headband">
          <div class="navbar navbar-expand-lg pt-1 shadow p-3 mb-5 bg-white">
              <a class="navbar-brand px-1 ml-5" href="projet_sublime.php"> <abbr title="MydoctorHome"><img src="Images/logo.png"/></abbr></a>
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>

<!--
                <div class="collapse navbar-collapse justified-end" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item active pl-5 pr-5 mt-3">
                        <form class="form-inline">
                        <input class="form-control mr-sm-2" type="search" placeholder="Recherche" aria-label="Search">
                        <button type="submit" class="btn btn-outline-success my-2 my-sm-0"><i class="icon-white icon-eye-open"></i> Chercher</button>
                        </form>
                        </li>
                    -->
                        <li class="nav-item px-1 ml-5">
                            <a class="nav-link text-center" href="projet_sublime.php">
                                <span>Accueil</span><br/>
                                <i class="fa p-1 fa-fw fa-home"></i>
                            </a>
                        </li>

                        <li class="nav-item px-1">
                            <a class="nav-link text-center" href="reseau.php">
                                <span>Réseau</span><br/>
                                <i class="fa p-1 fa-fw fa-users"></i>
                            </a>
                        </li>
                        <li class="nav-item dropdown px-1">
                            <a class="nav-link dropdown-toggle text-center" href="pharmacie.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span>Pharmacie</span><br/>
                                <i class="fa p-1 fa-fw fa-cart-plus"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="pharmacie_proximite.php">Pharmacie à proximité</a>
                                <a class="dropdown-item" href="pharmacie.php"> Pharmacie en ligne</a>
                            </div>
                        </li>


                        <li class="nav-item dropdown px-1">
                            <a class="nav-link dropdown-toggle text-center" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span>Notifications</span><br/>
                                <i class="fa p-1 fa-fw fa-bell"></i>



                    <?php
 try
{

    $bdd= new PDO('mysql:host=localhost;dbname=mydoctorhome','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}catch(Exception $e)
{
    die('Erreur :' .$e->getMessage());
}

                    $reponse= $bdd->query("SELECT * from notifications where statut='unread' ");
                    $donnees=$reponse->fetch();

                      $nombre=$bdd->query("SELECT count(*) from notifications where statut='unread' ");
                      $nombre=$nombre->fetch();

                            ?>

                             <span class="badge badge-danger"><?= $nombre['count(*)']; ?></span>

                                <?php
                        
                             $reponse->closeCursor();
                                ?>


                            </a>
                            

                            <div class="dropdown-menu">

    <?php

try
{
    /*  connexion a la base de donnée   */


    $bdd= new PDO('mysql:host=localhost;dbname=mydoctorhome','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}catch(Exception $e)
{
    die('Erreur :' .$e->getMessage());
}

                    $reponse= $bdd->query("SELECT * from notifications where statut='unread' ");
                        
                        ?>
                            <?php 
                                    while ($donnees = $reponse->fetch()) { ?>

                                    <a href="#">
                                

                                        <small class="dropdown-item"><i class="p-1"><?= $donnees['date'];  ?></i></small><br>
                                        <small class="dropdown-item"><i class="p-1"><?= $donnees['nom'];  ?></i></small><br>
                                        <small class="dropdown-item"><i class="p-1"><?= $donnees['message'];  ?></i></small>
                                     
                                    </a>
                              <?php  }    ?>

                                   
                            </div>
                        </li>
                      
                        <li  class="nav-item px-1">
                            <a href="cart.php" class="nav-link">
                                <span>Panier</span><br/>
                                <i class="fa fa-fw fa-shopping-cart"></i>


<?php
 try
{

    $bdd= new PDO('mysql:host=localhost;dbname=mydoctorhome','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}catch(Exception $e)
{
    die('Erreur :' .$e->getMessage());
}



                
                      $nombre=$bdd->prepare("SELECT count(*) from panier where client=? ");

                          $user=$bdd->prepare("SELECT * from Abonne where idAbonne=? ");
                      $user->execute(array($_SESSION['id']));
                       $user=$user->fetch();    

                      $nombre->execute(array($user['idAbonne']));
                      $nombre=$nombre->fetch();

                             
                            if($nombre['count(*)']>0){
                                ?>
                             <span class="badge badge-light"><?= $nombre['count(*)']; ?></span>

                                <?php
                        }
                             $reponse->closeCursor();
                                ?>


                        </a>
                        </li>
                        <li class="nav-item px-1">
                            <a href="forum.php" class="nav-link text-center">
                                <span>Forum</span><br>
                                <i class="fa fa-fw fa-comments-o"></i>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-center" href="profil.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span>Mon compte</span><br>
                                <i class="fa fa-fw fa-user-circle-o"></i>
                                <!--<span class="caret"> </span>-->
                            </a>


                            <ul class="dropdown-menu">
                                <li><a href="profil.php" class="dropdown-item"><i class="fa fa-fw fa-user"></i> Mon profil</a></li>
                                <li><a href="#" class="dropdown-item"><i class="fa fa-fw fa-list-alt"></i> Mes commandes</a></li>
                                 <!--  <li><a href="#"><i class="icon icon-pencil"></i> Editer mon compte</a></li>
                                <li><a href="#"><i class="icon icon-trash"></i> Suprimer mon compte</a></li> -->
                                <li class="divider"></li>
                            <li>
                                <a href="deconnexion.php" class="dropdown-item"><i class="fa fa-power-off"></i> Deconnexion</a>
                            </li>

                            </ul>
                        </li>

 <?php 
 try
{
    $bdd= new PDO('mysql:host=localhost;dbname=mydoctorhome','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}catch(Exception $e)
{
    die('Erreur :' .$e->getMessage());
}

$req = $bdd->prepare('SELECT * from Abonne  where idAbonne=?');
            $req -> execute(array($_SESSION['id']));
                    $donnees=$req->fetch();

 ?>


                        <li class="nav-item pl-4"><?php echo '<b class="nav-link pt-3" style="color:green
                        "> Bonjour'.'   '. $_SESSION['prenom'].'</b>';?></li>
                       <img src="membres/avatar/<?php echo $donnees['Email']; ?>" class="nav-link avatar" /> 
                         
                    </ul>
                </div>
                </div>
            </div>


        <div class="container">
   <br />
   
   <h3 align="center">Messagerie</a></h3><br />
   <br />
   
   <div class="table-responsive">
    
    <p align="right">Bienvenue  <?php echo $_SESSION['prenom'];  ?> - <a href="projet_sublime.php">Quitter</a></p><br><br><br>
    
   </div>
 

<div id="chat-container">
	
	<div id="search-container">

		<form method="POST" autocomplete="off"> 
		<input type="search" placeholder="Recherche" name="recherche" id="recherche">
		<div id="display-results">

	</div>

	</form>
</div>

	<div id="conversation-list">

		<?php


$statement = $bdd->prepare(" SELECT * FROM Abonne WHERE idAbonne =?");
$statement->execute(array($_SESSION['id']));
$result = $statement->fetch();

$select=$bdd->prepare("SELECT * from amis where user_id1=? OR user_id2=? AND statut=?");
$select->execute(array($result['idAbonne'],$result['idAbonne'],0));
$select=$select->fetchAll();

foreach($select as $row)
{
  if ($row['id'] != $_SESSION['id'] ) {
  
?>

		 <div class="conversation">
		 	
		 
<?php

if ($row['user_id1'] != $_SESSION['id'] ) {

  $statement = $bdd->prepare(" SELECT * FROM Abonne WHERE idAbonne =?");
$statement->execute(array($row['user_id1']));
$resultat = $statement->fetch();

?>
<img  src="membres/avatar/<?php echo $resultat['Email']; ?>" width="35"  class="img-circle" /> 

<?php
echo '<a style="color:white" class="start_chat" data-touserid="'.$resultat['idAbonne'].'" data-tousername="'.$resultat['idAbonne'].'"><div class="title-text">'.$resultat['Nom'].' '.$resultat['Prenom'].'</a><br>';

}else if ($row['user_id2'] != $_SESSION['id'] ) {

  $statement = $bdd->prepare(" SELECT * FROM Abonne WHERE idAbonne =?");
$statement->execute(array($row['user_id2']));
$resulta = $statement->fetch();

?>
<img  src="membres/avatar/<?php echo $resulta['Email']; ?>" width="35"  class="img-circle" /> 

<?php

echo '<a style="color:white" class="start_chat" data-touserid="'.$resulta['idAbonne'].'" data-tousername="'.$resulta['idAbonne'].'"><div class="title-text">'.$resulta['Nom'].' '.$resulta['Prenom'].'</a><br>';


}
?><br>

		 </div>	


		 </div>
<?php
  }
}
?>

	</div>


	<div id="new-message-container">
		
		
	</div>

	<div id="chat-form">


	</div>


<div id="chat-title">

	<!-- <span style="color:green">Daurian Balenvokolo</span>
	<img src="Images/corbeille.png" height="40px" alt="Delete conversation"/> -->

	</div>

	<div id="chat-message-list">
		
    <div id="user_model_details"></div>
		
	</div>


</div>
 </div><br><br><br><br><br><br>


<script>  
$(document).ready(function(){

 fetch_user();

 setInterval(function(){
  update_last_activity();
  fetch_user();
  update_chat_history_data();
 }, 5000);

 function fetch_user()
 {
  $.ajax({
   url:"fetch_user.php",
   method:"POST",
   success:function(data){
    $('#user_details').html(data);
   }
  })
 }

 function update_last_activity()
 {
  $.ajax({
   url:"update_last_activity.php",
   success:function()
   {

   }
  })
 }

 function make_chat_dialog_box(to_user_id, to_user_name)
 {
  var modal_content = '<div id="user_dialog_'+to_user_id+'" class="user_dialog" title="Vous êtes en conversation avec '+to_user_name+'">';
  modal_content += '<div style="height:400px; overflow-y: scroll; margin-bottom:24px; padding:16px;" class="chat_history" data-touserid="'+to_user_id+'" id="chat_history_'+to_user_id+'">';
  modal_content += fetch_user_chat_history(to_user_id);
  modal_content += '</div>';
  modal_content += '<div class="form-group">';
  modal_content += ' <input type="text"style="padding: 29px" placeholder="Saisissez un message" class="form-control form-control-lg" name="chat_message_'+to_user_id+'" id="chat_message_'+to_user_id+'"> <form method="POST"  enctype="multipart/form-data"> <input type="file" name="avatar" id = "avatar"> <input type="submit" name="valider" id = "valider" value="valider"> </form>';
  modal_content += '</div><div class="form-group">';
  modal_content+= '<button style="margin-left:35	px" type="submit" name="send_chat" id="'+to_user_id+'" class="send_chat btn-success" > Envoyer</button></div></div>';



  $('#user_model_details').html(modal_content);
 }

 $(document).on('click', '.start_chat', function(){
  var to_user_id = $(this).data('touserid');
  var to_user_name = $(this).data('tousername');
  make_chat_dialog_box(to_user_id, to_user_name);
  $("#user_dialog_"+to_user_id).dialog({
   autoOpen:false,
   width:400
  });
  $('#user_dialog_'+to_user_id).dialog('open');
 });

 $(document).on('click', '.send_chat', function(){
  var to_user_id = $(this).attr('id');
  var chat_message = $('#chat_message_'+to_user_id).val();
  $.ajax({
   url:"insert_chat.php",
   method:"POST",
   data:{to_user_id:to_user_id, chat_message:chat_message},
   success:function(data)
   {
    $('#chat_message_'+to_user_id).val('');
    $('#chat_history_'+to_user_id).html(data);
   }
  })
 });

 function fetch_user_chat_history(to_user_id)
 {
  $.ajax({
   url:"fetch_user_chat_history.php",
   method:"POST",
   data:{to_user_id:to_user_id},
   success:function(data){
    $('#chat_history_'+to_user_id).html(data);
   }
  });
 }

 function update_chat_history_data()
 {
  $('.chat_history').each(function(){
   var to_user_id = $(this).data('touserid');
   fetch_user_chat_history(to_user_id);
  });
 }

 $(document).on('click', '.ui-button-icon', function(){
  $('.user_dialog').dialog('destroy').remove();
 });
 $(document).on('focus', '.chat_message', function(){
  var is_type = 'yes';
  $.ajax({
   url:"update_is_type_status.php",
   method:"POST",
   data:{is_type:is_type},
   success:function()
   {

   }
  })
 });

 $(document).on('blur', '.chat_message', function(){
  var is_type = 'no';
  $.ajax({
   url:"update_is_type_status.php",
   method:"POST",
   data:{is_type:is_type},
   success:function()
   {
    
   }
  });
 });

});  
</script>


<!-- js -->
<script scr="http://code.jquery.com/jquery.js"></script>
<script src="js/bootstrap.min.js"></script> 
<script src="js/jquery-latest.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/recherche.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<!--fin ajout de daurian du 2/07/2020  -->



 <?php
include('pied.php');
 ?>

</body>
</html>
