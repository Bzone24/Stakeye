<?php
include "../db.php";
include '../syncwalletbalance.php';
include '../transactionformainwallet.php';

$name=$_POST['name'] ?? '';
$id=$_POST['id'] ?? '';
$mobile=$_POST['mobile'] ?? '';
$email=$_POST['email'] ?? '';
$password=$_POST['password'] ?? '';
$amount=$_POST['amount'] ?? '';
$remark=$_POST['remark'] ?? '';
$mode=$_POST['mode'] ?? '';
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
	//Add from main balance
addToMain($id, $amount);

$stmt2 = $db->query("select WALLET from USERS where ID='$id';");
while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
{
$balance=$row2['WALLET'] ?? '';
}
$stmt1 = "insert into TRANSACTIONS(USER_ID,DATE_TIME,AMOUNT,BALANCE,REMARK) values ('$id',now(),'$amount','$balance','$remark');";
$db->query($stmt1);
$name=str_replace("a","X","$name");
$name=str_replace("e","X","$name");
$name=str_replace("i","X","$name");
$name=str_replace("o","X","$name");
$name=str_replace("u","X","$name");
$name=str_replace("b","X","$name");
$name=str_replace("s","X","$name");
$name=str_replace("g","X","$name");
$stmt1 = "insert into PAYMENTS(NAME,AMOUNT,MODE,DATE) values ('$name','$amount','$mode',now());";
$db->query($stmt1);
}
header("location: user_edit.php?id=$id&msg=Updated");
?>