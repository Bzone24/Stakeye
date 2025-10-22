<?php
session_start();
$user_id=$_SESSION['USER_ID'] ?? '';
include "db.php";
if($user_id==""){
	header("location: login.php");
}
$name=$_POST['name'] ?? '';
$password1=$_POST['password'] ?? '';
$options = [
'cost' => 12,
];
$password=password_hash("$password1", PASSWORD_BCRYPT, $options);
$stmt1 = "update USERS set NAME='$name' where ID='$user_id';";
$db->query($stmt1);
if($password1!=""){
$stmt1 = "update USERS set PASSWORD='$password' where ID='$user_id';";
$db->query($stmt1);
}
header("location: profile.php?msg=Updated");
?>