<?php
session_start();
$user_id=$_SESSION['USER_ID'] ?? '';
$admin=$_SESSION['ADMIN'] ?? '';
include "../db.php";
if($user_id=="" || $admin==""){
        header("location: logout.php");
}
include '../syncwalletbalance.php';
include '../transactionformainwallet.php';
$name=$_POST['name'] ?? '';
$id=$_POST['id'] ?? '';
$mobile=$_POST['mobile'] ?? '';
$email=$_POST['email'] ?? '';
$password=$_POST['password'] ?? '';
$amount=$_POST['amount'] ?? '';
$remark=$_POST['remark'] ?? '';
$stmt1 = "update USERS set NAME='$name', MOBILE='$mobile', EMAIL='$email' where ID='$id';";
$db->query($stmt1);
if($password!=""){
$options = [
'cost' => 12,
];
$password=password_hash("$password", PASSWORD_BCRYPT, $options);
$stmt1 = "update USERS set PASSWORD='$password' where ID='$id';";
$db->query($stmt1);	
}
if($amount!=""){
$stmt1 = "update USERS set WALLET=WALLET + $amount where ID='$id';";
$db->query($stmt1);

//Add to main balance
addToMain($id, $amount);
$stmt2 = $db->query("select WALLET from USERS where ID='$id';");
while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
{
$balance=$row2['WALLET'] ?? '';
}
$stmt1 = "insert into TRANSACTIONS(USER_ID,DATE_TIME,AMOUNT,BALANCE,REMARK) values ('$id',now(),'$amount','$balance','$remark');";
$db->query($stmt1);
}
header("location: user_edit.php?id=$id&msg=Updated");
?>
