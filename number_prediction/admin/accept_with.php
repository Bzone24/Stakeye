<?php
session_start();
$user_id=$_SESSION['USER_ID'] ?? '';
$admin=$_SESSION['ADMIN'] ?? '';
include "../db.php";
include 'syncwalletbalance.php';
include 'transactionformainwallet.php';

if($user_id=="" || $admin==""){
        header("location: logout.php");
}else{
include "../db.php";
$id=$_GET['id'] ?? '';
$stmt2 = $db->query("select  USER_ID, AMOUNT from WITHDRAW where ID='$id';");
while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
{
$user_id1=$row2['USER_ID'] ?? '';
$amount=$row2['AMOUNT'] ?? '';
}
$stmt2 = $db->query("select  WALLET from USERS where ID='$user_id1';");
while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
{
$wallet=$row2['WALLET'] ?? '';
}
if($wallet >= $amount){
$stmt1 = "update USERS set WALLET=WALLET - $amount where ID='$user_id1';";
$db->query($stmt1);

//dedeuct from main balance
deductFromMain($user_id, $amount);


$stmt1 = "update WITHDRAW set STATUS='COMPLETED' where ID='$id';";
$db->query($stmt1);
$stmt2 = $db->query("select  WALLET from USERS where ID='$user_id1';");
while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
{
$balance=$row2['WALLET'] ?? '';
}
$stmt1 = "insert into TRANSACTIONS(USER_ID,DATE_TIME,AMOUNT,BALANCE,REMARK) values ('$user_id1',now(),'$amount','$balance','Withdraw');";
$db->query($stmt1);
header("location: payment_queue.php?msg=Accepted");
}else{
header("location: payment_queue.php?msg=Low Balance");
}
}
?>
