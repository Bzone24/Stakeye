<?php
session_start();
$user_id=$_SESSION['USER_ID'] ?? '';
$admin=$_SESSION['ADMIN'] ?? '';
include "../db.php";
if($user_id=="" || $admin==""){
	header("location: login.php");
}else{
$password1=$_POST['password'] ?? '';
$options = [
'cost' => 12,
];
$password=password_hash("$password1", PASSWORD_BCRYPT, $options);
$stmt1 = "update SETTINGS set PASSWORD='$password';";
$db->query($stmt1);
header("location: logout.php");
}
?>
