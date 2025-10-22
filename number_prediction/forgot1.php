<?php
include "header.php";
$user_id=$_SESSION['USER_ID'] ?? '';
if($user_id!=""){
    header("location: dashboard.php");
}
$mobile=$_GET['mobile'] ?? '';
?>


<div class="main-login-pop">
<h2>Forgot Password</h2>
<form method="post" action="forgot1_check.php" id="frgt_frm">
<font style='color:red;'>
<?php echo $_GET['msg'] ?? ''; ?>
</font>
<input type='hidden' name='mobile' value="<?php echo $mobile;?>">
<input type="number" name="otp" placeholder="Enter OTP" class='form-control' style='border: 1px solid black;border-radius:0;height: 40px;%'  required><br>
<input type="text" name="password" placeholder="New Password" style='border: 1px solid black;border-radius:0;height: 0px;%' required>
<input type="submit" value="Change Password" />
</form>
<div class="login-with">

</div>

<div class="register-area">
<h4 style='color:black;'>Already have an account? <a href="login.php">Sign IN!</a></h4>
</div>
</div>



<?php
include "footer.php";
?>
