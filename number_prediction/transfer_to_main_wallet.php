<?php

include "header.php";
$user_id = $_SESSION['USER_ID'] ?? '';
if ($user_id == "") {
    header("location: login.php");
}

include "maindb.php";

//get balance from main wallet

$stmt1 = $db->query("select WALLET  from USERS where ID =$user_id;");
$wallet = $stmt1->fetchColumn();
 
 
 
?>
<br>
<div class="container-fluid">
<div class="container">
<font style='color:red;'><?php echo $_GET['msg'] ?? '';?></font>
<div class='row'>
   <div class="col-xs-12">
<center><b>
Transfer to main wallet
</b>
</center>
    <br><br>
   
   <form action='transfer_to_main_wallet_check.php' method='POST' accept='image/jpg,image/jpeg,image/png' enctype='multipart/form-data'>
   Amount in game wallet : 
   <input type='number'disabled class='form-control'  value="<?php echo floatval($wallet);?>">
 
   <br/>
   Enter amount you want to add in main wallet (min : 10)
    <input type='number' class='form-control' name='amount' max="<?php echo floatval($wallet);?>"
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
