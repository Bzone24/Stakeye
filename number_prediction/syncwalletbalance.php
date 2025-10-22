<?php 

@session_start();
 
if(isset($_SESSION['USER_ID'])){
      $user_id = $_SESSION['USER_ID'] ?? '';
    include "maindb.php";
    include "db.php";
    $crosssql = $db->query("select EMAIL  from USERS where ID =$user_id");
    $email = $crosssql->fetchColumn();
    $query = "SELECT * FROM users WHERE email = '" . $email . "'";
    $stmt = $maindb->query($query);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
   
    //log into local db
      $stmt1 = "update USERS set WALLET =". $result['balance']." where ID=".$user_id;
    $db->query($stmt1);
     
}

 
?>