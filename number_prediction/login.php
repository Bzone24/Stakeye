<?php

header("location: https://stakeye.com/");
exit();

include "header.php";
$user_id=$_SESSION['USER_ID'] ?? '';
if($user_id!=""){
    header("location: dashboard.php");
}
$app=$_SERVER['HTTP_X_REQUESTED_WITH'];
?>


<div class="main-login-pop">
 <h2>user login</h2>
<form method="post" name="log_frm" id="log_frm" action="login_check.php">
<font style='color:red;'>
<?php echo $_GET['msg'] ?? ''; ?>
</font>
<input type="text" name="username" id="uname" placeholder="Username" required/>
<input type="password" name="password" id="pass" placeholder="Password" required/>
<input type="submit" value="Login" />
</form>
<div class="login-with">

</div>

<br>
<div class="register-area">
<h4><a href="forgot.php" style='font-weight:bold;color:blue;'>Forgot Password!</a></h4>
</div><br>
<div class="register-area">
<h4 style='color:black;'>Don't have an account? <a href="registration.php" style='font-weight:bold;color:blue;'>Register Now!</a></h4>
</div>
</div>



<?php
include "footer.php";
?>
