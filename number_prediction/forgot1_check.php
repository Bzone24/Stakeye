<?php
include "db.php";
$mobile=$_POST['mobile'] ?? '';
$otp=$_POST['otp'] ?? '';
$password=$_POST['password'] ?? '';
$stmt2 = $db->query("select ID from FORGOT where MOBILE='$mobile' and OTP='$otp' and STATUS is NULL and DATE > now() - INTERVAL 15 MINUTE;");
while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
{
$check_otp=$row2['ID'] ?? '';
}
if(@$check_otp != ""){
$options = [
'cost' => 12,
];
$new_password=password_hash("$password", PASSWORD_BCRYPT, $options);
$stmt1 = "update USERS set PASSWORD='$new_password' where MOBILE='$mobile'";
$db->query($stmt1);
$stmt1 = "update FORGOT set STATUS='USED' where MOBILE='$mobile' and OTP='$otp'";
$db->query($stmt1);
header("location: login.php?msg=Password changed");
}else{
header("location: forgot1.php?mobile=$mobile&msg=Wrong OTP");
}
?>
