<?php
try
{
    $bdd= new PDO('mysql:host=localhost;dbname=mydoctorhome','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}catch(Exception $e)
{
    die('Erreur :' .$e->getMessage());
}


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
   $user_name = '<b class="text-success">Vous</b>';
  }
  else
  {
   $user_name = '<b class="text-danger">'.get_user_name($row['from_user_id'], $bdd).'</b>';
  }
  $output .= '
  <li style="border-bottom:1px dotted #ccc">
   <p>'.$user_name.' - '.$row["chat_message"].'
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

function get_user_name($id, $bdd)
{
 $query = "SELECT prenom FROM utilisateurs WHERE id = '$id'";
 $statement = $bdd->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  return $row['prenom'];
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
















?>