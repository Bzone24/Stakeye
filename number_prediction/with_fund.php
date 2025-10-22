<?php
include "header.php";
$user_id=$_SESSION['USER_ID'] ?? '';
if($user_id==""){
	header("location: login.php");
}
?>
<br>
<div class="container-fluid">
<div class="container">
<font style='color:red;'><?php echo $_GET['msg'] ?? '';?></font>
<div class='row'>
	<div class="col-xs-12">
	<br><br>
	
	<form action='with_fund_check.php' method='POST' >

<input type='number' class='form-control' name='amount' placeholder='Enter Amount' required>
Minimum Amount: <?php echo $withdraw_amount;?>
<br><br>
<input type='text' name='upi' class='form-control' placeholder='Enter UPI ID' /><br>
or<br><br>
<input type='text' name='bank' class='form-control' placeholder='Bank Name' /><br>
<input type='text' name='account' class='form-control' placeholder='Account number' /><br>
<input type='text' name='ifsc' class='form-control' placeholder='IFSC Code' /><br>
<input type='submit' value='Submit' class='btn btn-danger'>
</form>
<br><br>
<br>
Note: We are not responsible if you enter wrong UPI ID or Bank Details.
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
