

<?php
try
{
    $bdd= new PDO('mysql:host=localhost;dbname=mydoctorhome','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}catch(Exception $e)
{
    die('Erreur :' .$e->getMessage());
}



$img=$bdd->query('SELECT * from chat_message');
$img=$img->fetch();
?>

<?php
function fetch_user_last_activity($id, $bdd)
{
 $query = "
 SELECT * FROM login_details 
 WHERE id = '$id' 
 ORDER BY last_activity DESC 
 LIMIT 1
 ";
 $statement = $bdd->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  return $row['last_activity'];
 }
}

function fetch_user_chat_history($from_user_id, $to_user_id, $bdd)
{

$select=$bdd->prepare('SELECT * from Abonne where idAbonne=?');
$select->execute(array($to_user_id));
$user=$select->fetch();

 $query = "
 SELECT * FROM chat_message 
 WHERE (from_user_id = '".$from_user_id."' 
 AND to_user_id = '".$to_user_id."') 
 OR (from_user_id = '".$to_user_id."' 
 AND to_user_id = '".$from_user_id."') 
 ORDER BY timestamp ASC
 ";
 $statement = $bdd->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 $output = '<ul class="list-unstyled">';
 foreach($result as $row)
 {
  $user_name = '';
  if($row["from_user_id"] == $from_user_id)
  { 
    ?>

    <img  width="30"  class="img-circle" src="membres/avatar/<?php echo $_SESSION['mail']; ?>" >

    <?php
   $user_name = '<b style="color:green"> Vous</b>';
  }
  else
  {
    ?>

    <img  width="30"  class="img-circle" src="membres/avatar/<?php echo $user['Email']; ?>" >

<?php
   $user_name = '<b style="color:blue" >'.get_user_name($row['from_user_id'], $bdd).'</b>';
  }

  $output .= '

  <p>'; 

   if(!is_null($row['image'] )){ ?>
   <a href="ordonnance.php?id=<?= $row["chat_message_id"] ?>">Ordonnance</a>

<?php

}
  echo' <div style="background:pink;border-radius:10px"><p style="margin-left:20px;margin-top:20px">'.$user_name.' <br><p style="margin-left:50px"> '.$row["chat_message"].
   '</p><div>
      <small style="margin-left:100px">'.$row['timestamp'].'</small>
    </div><br>
   </p>
  </p></div><br><br>
  '; 
 }
 $output .= '</ul>';
 return $output;
}

function get_user_name($id, $bdd)
{
 $query = "SELECT Prenom FROM Abonne WHERE idAbonne = '$id'";
 $statement = $bdd->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  return $row['Prenom'];
 }
}

function count_unseen_message($from_user_id, $to_user_id, $bdd)
{
 $query = "
 SELECT * FROM chat_message 
 WHERE from_user_id = '$from_user_id' 
 AND to_user_id = '$to_user_id' 
 AND status = '1'
 ";
 $statement = $bdd->prepare($query);
 $statement->execute();
 $count = $statement->rowCount();
 $output = '';
 if($count > 0)
 {
  $output = '<span class="label label-success">'.$count.'</span>';
 }
 return $output;
}

function fetch_is_type_status($id, $bdd)
{
 $query = "
 SELECT is_type FROM login_details 
 WHERE id = '".$id."' 
 ORDER BY last_activity DESC 
 LIMIT 1
 "; 
 $statement = $bdd->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 $output = '';
 foreach($result as $row)
 {
  if($row["is_type"] == 'yes')
  {
   $output = ' - <small><em><span class="text-muted">Typing...</span></em></small>';
  }
 }
 return $output;
}

function fetch_group_chat_history($bdd)
{
 $query = "
 SELECT * FROM chat_message 
 WHERE to_user_id = '0'  
 ORDER BY timestamp DESC
 ";

 $statement = $bdd->prepare($query);

 $statement->execute();

 $result = $statement->fetchAll();

 $output = '<ul class="list-unstyled">';
 foreach($result as $row)
 {
  $user_name = '';
  if($row["from_user_id"] == $_SESSION["id"])
  {
   $user_name = '<b class="text-success">You</b>';
  }
  else
  {
   $user_name = '<b class="text-danger">'.get_user_name($row['from_user_id'], $bdd).'</b>';
  }

  $output .= '

  <li style="border-bottom:1px dotted #ccc">
   <p>'.$user_name.' - '.$row['chat_message'].' 
    <div align="right">
     - <small><em>'.$row['timestamp'].'</em></small>
    </div>
   </p>
  </li>
  ';
 }
 $output .= '</ul>';
 return $output;
}

?>
