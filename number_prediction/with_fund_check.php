<?php
session_start();
$user_id=$_SESSION['USER_ID'] ?? '';
include "db.php";
$amount=$_POST['amount'] ?? '';
$upi=$_POST['upi'] ?? '';
$bank=$_POST['bank'] ?? '';
$account=$_POST['account'] ?? '';
$ifsc=$_POST['ifsc'] ?? '';
$stmt2 = $db->query("select WITHDRAW from SETTINGS;");
while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
{
        $withdraw=$row2['WITHDRAW'] ?? '';
}
$stmt2 = $db->query("select WALLET from USERS where ID='$user_id';");
while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
{
        $wallet=$row2['WALLET'] ?? '';
}
$count=0;
$stmt2 = $db->query("select count(*) as count from WITHDRAW where USER_ID='$user_id' and STATUS is NULL;");
while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
{
        $count=$row2['count'] ?? '';
}
if($count == "0"){ 
if($amount >= $withdraw){
if($wallet >= $amount){
$stmt1 = "insert into WITHDRAW(USER_ID,AMOUNT,UPI,TIME,BANK,IFSC,ACCOUNT) values ('$user_id','$amount','$upi',now(),'$bank','$ifsc','$account')";
$db->query($stmt1);
header("location: with_fund.php?msg=Request Received");
}else{
header("location: with_fund.php?msg=Not enough balance.");
}
}else{
header("location: with_fund.php?msg=Minimum amount is $withdraw.");
}
}else{
header("location: with_fund.php?msg=One request is pending.");
}
?>
