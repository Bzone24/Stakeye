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
	<form action='profile_check.php' method='POST'>
<?php
$stmt2 = $db->query("select EMAIL, MOBILE from USERS where ID='$user_id';");
while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
{
$email=$row2['EMAIL'] ?? '';
$mobile=$row2['MOBILE'] ?? '';
}
echo "<label>Name</label>";
echo "<input type='text' name='name' value='$user_name' class='form-control' required><br>";
echo "<label>Email</label>";
echo "<input type='text' value='$email' class='form-control' disabled><br>";
echo "<label>Mobile</label>";
echo "<input type='number' value='$mobile' max='9999999999' min='1111111111' class='form-control' disabled><br>";
echo "<label>Reset Password</label>";
echo "<input type='password' name='password' placeholder='Use only to reset password' class='form-control'><br>";
?>
<input type='submit' value='Update' class='btn btn-danger'>
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