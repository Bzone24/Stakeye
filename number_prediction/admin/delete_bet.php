<?php
session_start();
$user_id=$_SESSION['USER_ID'] ?? '';
$admin=$_SESSION['ADMIN'] ?? '';
include "../db.php";
include '../syncwalletbalance.php';
include '../transactionformainwallet.php';

if($user_id=="" || $admin==""){
        header("location: logout.php");
}
include "../db.php";
$id=$_GET['id'] ?? '';
$b_id=$_GET['b_id'] ?? '';
$stmt2 = $db->query("select AMOUNT from BET_TRANSACTIONS where ID='$b_id';");
while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
{
$amount=$row2['AMOUNT'] ?? '';
}
$stmt1 = "update BET_TRANSACTIONS set STATUS='DELETED' where ID='$b_id'";
$db->query($stmt1);
$stmt1 = "update USERS set WALLET=WALLET + $amount where ID='$id';";
$db->query($stmt1);
//Add to main balance
addToMain($id, $amount);

$stmt2 = $db->query("select WALLET from USERS where ID='$id';");
while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
{
$balance=$row2['WALLET'] ?? '';
}
$stmt1 = "insert into TRANSACTIONS(USER_ID,DATE_TIME,AMOUNT,BALANCE,REMARK,BET_ID) values ('$id',now(),'$amount','$balance','Bet Deleted','$b_id');";
$db->query($stmt1);
header("location: user_bet.php?id=$id&msg=Bet Deleted");
?>
