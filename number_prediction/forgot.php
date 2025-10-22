<?php
include "header.php";
$user_id=$_SESSION['USER_ID'] ?? '';
if($user_id!=""){
    header("location: dashboard.php");
}
?>


<div class="main-login-pop">
<h2>Forgot Password</h2>
<form method="post" action="forgot_check.php" id="frgt_frm">
<?php echo $_GET['msg'] ?? ''; ?>
<input type="text" name="mobile" id="mobile" placeholder="Mobile" minlength="10" maxlength="10" required>
<input type="submit" value="Submit" />
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
