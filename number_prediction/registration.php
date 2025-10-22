<?php
header("location: https://stakeye.com/");
exit();
include "header.php";
$user_id=$_SESSION['USER_ID'] ?? '';
if($user_id!=""){
	header("location: dashboard.php");
}
?>


<div class="main-register-pop">
<h2>user registration</h2>
<form method="post" action="register_check.php">
<?php echo $_GET['msg'] ?? ''; ?>
<input type="text" name="name" id="name" placeholder="Full Name" required>
<input type="text" name="email" id="email" placeholder="Email" required>
<input type="password" name="password" id="password" placeholder="Password" required>
<input type="text" name="mobile" id="mobile" placeholder="Mobile" maxlength="10" required>
<p><input type="checkbox" id="agree_box" required> I agree <a href="terms-and-conditions.php" target="_blank">Terms and Conditions</a></p>
<input type="submit" value="Register">
</form>
<div class="register-area">
<h4 style='color:black;'>Already have an account? <a href="login.php">Login Now!</a></h4>
</div>
<br><br>
</div>
<?php
include "footer.php";
?>
