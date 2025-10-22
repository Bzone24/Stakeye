<?php
include "header.php";
?>

  <!-- Content Wrapper. Contains page content -->
  <div class='content-wrapper'>
    <!-- Content Header (Page header) -->
    <div class='content-header'>
      <div class='container-fluid'>
        <div class='row mb-2'>
          <div class='col-sm-6'>
            <font style='color:red;'>
			<?php echo $_GET['msg'] ?? '';?>
			</font>
          </div><!-- /.col -->
          <div class='col-sm-6'>
            <ol class='breadcrumb float-sm-right'>
              <li class='breadcrumb-item'><a href='index.php'>Home</a></li>
              <li class='breadcrumb-item active'>Settings</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class='content'>
      <div class='container-fluid'>
        <div class='row'>
			<div class='col-12'>
            <div class='card'>
              <div class='card-header border-transparent bg-gradient-primary'>
                <h3 class='card-title'>Settings</h3>
              </div>
              <div class='card-body p-0'>
			  <div class='card-body'>
                                
<?php
$stmt1 = $db->query("select OTP, OTP_KEY, RECHARGE, WITHDRAW, GATEWAY, GATEWAY_KEY, MOBILE, SINGLE, JODI, SINGLE_PATTI, DOUBLE_PATTI, TRIPPLE_PATTI, HALF_SANGAM, FULL_SANGAM, GPAY, PHONEPAY, PAYTM, STARLINE, STARLINE_SINGLE, STARLINE_DOUBLE, STARLINE_GAME, APP_NAME, GUESS, BONUS, REFER  from SETTINGS;");
while($row1 = $stmt1->fetch(PDO::FETCH_ASSOC))
{
$otp=$row1['otp'] ?? '';
$otp_key=$row1['otp_key'] ?? '';
$recharge_amount=$row1['RECHARGE'] ?? '';
$withdraw_amount=$row1['WITHDRAW'] ?? '';
$gateway=$row1['GATEWAY'] ?? '';
$gateway_key=$row1['GATEWAY_KEY'] ?? '';
$mobile=$row1['MOBILE'] ?? '';
$single=$row1['SINGLE'] ?? '';
$jodi=$row1['JODI'] ?? '';
$single_patti=$row1['SINGLE_PATTI'] ?? '';
$double_patti=$row1['DOUBLE_PATTI'] ?? '';
$tripple_patti=$row1['TRIPPLE_PATTI'] ?? '';
$half_sangam=$row1['HALF_SANGAM'] ?? '';
$full_sangam=$row1['FULL_SANGAM'] ?? '';
$paytm=$row1['PAYTM'] ?? '';
$phonepay=$row1['PHONEPAY'] ?? '';
$gpay=$row1['GPAY'] ?? '';
$starline_price=$row1['STARLINE'] ?? '';
$starline_patti_price=$row1['STARLINE_SINGLE'] ?? '';
$starline_dpatti_price=$row1['STARLINE_DOUBLE'] ?? '';
$starline_game=$row1['STARLINE_GAME'] ?? '';
$app_name=$row1['APP_NAME'] ?? '';
$guess=$row1['GUESS'] ?? '';
$bonus=$row1['BONUS'] ?? '';
$refer=$row1['REFER'] ?? '';
}
echo "
<div class='row'>
<div class='col-lg-6'>
<form action='settings_check.php' method='POST'>
<label>Mobile</label>
<input type='number' class='form-control' name='mobile' value='$mobile'><br>
<label>Haruf</label>
<input type='number' class='form-control' name='single' value='$single' required><br>
<label>JODI</label>
<input type='number' class='form-control' name='jodi' value='$jodi' required><br>
<label>UPI</label>
<input type='text' class='form-control' name='gpay' value='$gpay' required><br>
<label>Guess</label>
<select name='guess' class='form-control'>";
if($guess=="" || $guess=="YES"){
echo "<option value='YES'>YES</option>
<option value='NO'>NO</option>";
}else{
echo "<option value='NO'>NO</option><option value='YES'>YES</option>";
}
echo "</select><br>
<label>OTP</label>
<select name='otp' class='form-control'>";
if($otp=="" || $otp=="DVGROUP"){
echo "<option value='DVGROUP'>DVGROUP</option>";
echo "<option value='FAST2SMS'>FAST2SMS</option>";
}else{
echo "<option value='FAST2SMS'>FAST2SMS</option>";
echo "<option value='DVGROUP'>DVGROUP</option>";
}
echo "
</select><br>
<label>OTP Key</label>
<input type='otp_key' class='form-control' name='otp_key' value='$otp_key'><br>
<br>
</div>
<div class='col-lg-6'>
<label>Min. Recharge Amount</label>
<input type='number' class='form-control' name='recharge_amount' value='$recharge_amount' required><br>
<label>Min. Withdraw Amount</label>
<input type='number' class='form-control' name='withdraw_amount' value='$withdraw_amount' required><br>
<label>App File Name</label>
<input type='text' class='form-control' name='app_name' value='$app_name'><br>
<label>Payment Method</label>
<select name='gateway' class='form-control'>";
if($gateway=="" || $gateway=="MANUAL"){
echo "<option value='MANUAL'>MANUAL</option>";
echo "<option value='UPIGATEWAY'>UPIGATEWAY</option>";
}else{
echo "<option value='UPIGATEWAY'>UPIGATEWAY</option>";
echo "<option value='MANUAL'>MANUAL</option>";
}
echo "
</select>
<br>
<label>UPI Gateway Key</label>
<input type='text' class='form-control' name='gateway_key' value='$gateway_key'><br>
<label>First Recharge Bonus (0 for no bonus)</label>
<input type='number' class='form-control' name='bonus' value='$bonus'><br>
<label>Refer % on each recharge (0 for no reference bonus)</label>
<input type='number' class='form-control' name='refer' value='$refer'><br>
</div>
</div>
";

?>

												
				</div>
				
				<div class='card-footer clearfix'>
                <input class='btn btn-sm btn-primary float-right' value='Update' type='submit'>
                                </form>
              </div>
				
				</div></div>
              </div>
              <!-- /.card-body -->
              
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
		  
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php
include "footer.php";
?>
