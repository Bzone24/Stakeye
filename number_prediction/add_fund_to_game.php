<?php

include "header.php";
$user_id = $_SESSION['USER_ID'] ?? '';
if ($user_id == "") {
    header("location: login.php");
}

include "maindb.php";

//get balance from main wallet

$stmt1 = $db->query("select EMAIL  from USERS where ID =$user_id;");
 $email = $stmt1->fetchColumn();
 
 // Construct the SQL query (no placeholders, directly inserting $email)
$query = "SELECT * FROM users WHERE email = '" . $email . "'";
// Execute the query
$stmt = $maindb->query($query);
// Fetch the result
$result = $stmt->fetch(PDO::FETCH_ASSOC);
 
?>
<br>
<div class="container-fluid">
<div class="container">
<font style='color:red;'><?php echo $_GET['msg'] ?? '';?></font>
<div class='row'>
   <div class="col-xs-12">
<center><b>
 Add fund to game
</b>
</center>
    <br><br>
   
   <form action='add_fund_to_game_check.php' method='POST' accept='image/jpg,image/jpeg,image/png' enctype='multipart/form-data'>
   Amount in main wallet : 
   <input type='number'disabled class='form-control'  value="<?php echo floatval($result['balance']);?>">
 
   <br/>
   Enter amount you want to add in game wallet (min : 10)
    <input type='number' class='form-control' name='amount' max="<?php echo number_format($result['balance'], 0);?>"
     min="10" placeholder='Enter Amount' required>
    
<br><br>
 
<input type='submit' value='Submit' class='btn btn-danger'>
</form>
</div>
</form>   
</div>
<br><br><br>
</div>
</div>
<br>
<?php
include "footer.php";
?>
