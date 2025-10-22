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
$stmt2 = $db->query("select BONUS, REFER from SETTINGS;");
while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
{
$bonus_amount=$row2['BONUS'] ?? 0;
$refer_amount=$row2['REFER'] ?? 0;
}

$stmt2 = $db->query("select  USER_ID, MODE, AMOUNT from PAYMENT_QUEUE where ID='$id';");
while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
{
$user_id1=$row2['USER_ID'] ?? '';
$mode=$row2['MODE'] ?? '';
$amount=$row2['AMOUNT'] ?? '';
}
$stmt1 = $db->query("select NAME, MOBILE from USERS where ID='$user_id1';");
while($row1 = $stmt1->fetch(PDO::FETCH_ASSOC))
{
$name=$row1['NAME'] ?? '';
}
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
$stmt1 = "update USERS set WALLET=WALLET + $amount where ID='$user_id1';";
$db->query($stmt1);
//Add to main balance
addToMain($user_id1, $amount);
$stmt2 = $db->query("select ID from TRANSACTIONS  where USER_ID='$user_id1' and REMARK='Added';");
while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
{
$first_recharge=$row2['ID'] ?? '';
}
if(@$first_recharge == "" && $bonus_amount > 0){
$stmt1 = "update USERS set WALLET=WALLET + $bonus_amount where ID='$user_id1';";
$db->query($stmt1);
//Add to main balance
addToMain($user_id1, $bonus_amount);

$first_recharge_text=" + Bonus";
}
$stmt2 = $db->query("select WALLET, REFER_BY from USERS where ID='$user_id1';");
while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
{
$balance=$row2['WALLET'] ?? '';
$refer_by=$row2['REFER_BY'] ?? '';
}
$stmt1 = "insert into TRANSACTIONS(USER_ID,DATE_TIME,AMOUNT,BALANCE,REMARK) values ('$user_id1',now(),'$amount','$balance','Added$first_recharge_text');";
$db->query($stmt1);
$stmt1 = "update PAYMENT_QUEUE set STATUS='COMPLETED' where ID='$id';";
$db->query($stmt1);

if(@$refer_by!="" && $refer_amount > 0){
$referamount=($amount * $refer_amount) / 100;
$stmt1 = "update USERS set WALLET=WALLET + $referamount where ID='$refer_by';";
$db->query($stmt1);
//Add to main balance
addToMain($refer_by, $referamount);
$stmt2 = $db->query("select WALLET from USERS where ID='$refer_by';");
while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
{
$ref_balance=$row2['WALLET'] ?? '';
}
$stmt1 = "insert into TRANSACTIONS(USER_ID,DATE_TIME,AMOUNT,BALANCE,REMARK) values ('$refer_by',now(),'$referamount','$ref_balance','Bonus');";
$db->query($stmt1);
}

header("location: payment_queue.php?msg=Accepted");
?>
