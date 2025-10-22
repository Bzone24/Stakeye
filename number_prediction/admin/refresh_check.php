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
$game_id=$_GET['game'] ?? '';

$stmt2 = $db->query("select ID, WIN_AMOUNT, USER_ID, RESULT from BET_TRANSACTIONS where GAME_ID='$game_id' and DATE=CURDATE() and STATUS!='DELETED';");
while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
{
$bet_id=$row2['ID'] ?? '';
$win_amount=$row2['WIN_AMOUNT'] ?? '';
$user_id=$row2['USER_ID'] ?? '';
$result=$row2['RESULT'] ?? '';
$stmt3="update BET_TRANSACTIONS set RESULT='', WIN_AMOUNT='0', STATUS='' where ID='$bet_id';";
$db->query($stmt3);
if($result=="PASS"){
$stmt3="update USERS set WALLET=WALLET - $win_amount where ID='$user_id';";
$db->query($stmt3);
//dedeuct from main balance
deductFromMain($user_id, $win_amount);

$stmt3="delete from TRANSACTIONS where USER_ID='$user_id' and BET_ID='$bet_id' and GAME_ID is NULL";
$db->query($stmt3);
}
}

header("location: refresh.php?msg=Updated");
?>
