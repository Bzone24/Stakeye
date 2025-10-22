<?php
include "../db.php";
$name=$_POST['name'] ?? '';
$amount=$_POST['amount'] ?? '';
$win_amount=$_POST['win_amount'] ?? '';
$game=$_POST['game'] ?? '';
$stmt1 = "insert into WINNERS(NAME,AMOUNT,WIN_AMOUNT,GAME,TIME) values ('$name','$amount','$win_amount','$game',now());";
$db->query($stmt1);
header("location: winner.php?msg=Added");
?>