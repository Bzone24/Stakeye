<?php
session_start();
include "db.php";
$user_id=$_SESSION['USER_ID'] ?? '';
$password1=$_POST['password'] ?? '';
$mobile=$_POST['mobile'] ?? '';
$mobile_check="";
	$stmt1 = $db->query("select MOBILE from USERS where MOBILE='$mobile';");
    while($row1 = $stmt1->fetch(PDO::FETCH_ASSOC))
    {
        $mobile_check=$row1['MOBILE'] ?? '';
	}
if($mobile_check==""){
$options = [
'cost' => 12,
];
$password=password_hash("$password1", PASSWORD_BCRYPT, $options);
$stmt1 = "update USERS set PASSWORD='$password', MOBILE='$mobile' where ID='$user_id';";
$db->query($stmt1);
header("location: dashboard.php");
}else{
	header("location: mobile.php?msg=Mobile already Exist");
}
?>