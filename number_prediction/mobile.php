<?php
include "header.php";
$user_id=$_SESSION['USER_ID'] ?? '';
if($user_id==""){
	header("location: login.php");
}
?>


<div class="main-login-pop">
<h2>Enter details</h2>
<form method="post" name="mob_frm" id="mob_frm" action="mobile_check.php">
<?php echo $_GET['msg'] ?? ''; ?>
<input type="text" name="mobile" id="mobile" placeholder="Mobile" minlength="10" maxlength="10" required>
<input type="password" name="password" id="pass" placeholder="Set Password" required/>
<input type="submit" value="Update" />
</form>
</div>


<?php
include "footer.php";
?>