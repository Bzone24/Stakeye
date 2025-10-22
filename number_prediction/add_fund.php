<?php

include "header.php";
$user_id = $_SESSION['USER_ID'] ?? '';
if ($user_id == "") {
    header("location: login.php");
}
$mode = $_GET['mode'] ?? '';
$stmt1 = $db->query("select GPAY, PHONEPAY, PAYTM from SETTINGS;");
while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
    $paytm = $row1['PAYTM'] ?? '';
    $phonepay = $row1['PHONEPAY'] ?? '';
    $gpay = $row1['GPAY'] ?? '';
}
?>
<br>
<div class="container-fluid">
<div class="container">
<font style='color:red;'><?php echo $_GET['msg'] ?? '';?></font>
<div class='row'>
   <div class="col-xs-12">
<center><b>
<?php
    echo "UPI ID: $gpay";
?>  
</b>
</center>
    <br><br>
   
   <form action='add_fund_check.php' method='POST' accept='image/jpg,image/jpeg,image/png' enctype='multipart/form-data'>

<input type='number' class='form-control' name='amount' min="<?php echo $recharge_amount;?>" placeholder='Enter Amount' required>
Minimum Amount: <?php echo $recharge_amount;?>
<br><br>
<b>Screenshot</b>:
<input type='file' name='photo' class='form-control' required /><br>

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
