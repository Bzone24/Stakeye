<?php
session_start();
include "../db.php";
$username=$_POST['email'] ?? '';
$password=$_POST['password'] ?? '';
$stmt2 = $db->query("select  PASSWORD from SETTINGS where USERNAME='$username';");
while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
{
$password_check=$row2['PASSWORD'] ?? '';
}
if(password_verify($password, $password_check)){
		$_SESSION['ADMIN'] = "ADMIN";
                $_SESSION['USER_ID'] = "1";
		header("location: index.php");
}else{
	header("location: login.php?msg=Invalid Username/Password");
}
?>
