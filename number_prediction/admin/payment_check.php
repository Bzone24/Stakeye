<?php
include "../db.php";
$name=$_POST['name'] ?? '';
$amount=$_POST['amount'] ?? '';
$mode=$_POST['mode'] ?? '';
$stmt1 = "insert into PAYMENTS(NAME,AMOUNT,MODE,DATE) values ('$name','$amount','$mode',now());";
$db->query($stmt1);
header("location: payment.php?msg=Added");
?>