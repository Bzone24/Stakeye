<?php
session_start();
$user_id=$_SESSION['USER_ID'] ?? '';
include "db.php";
$amount=$_POST['amount'] ?? '';
$mode=$_POST['mode'] ?? '';
$target_dir="files/";
$rand=rand();
if(($_FILES["photo"]["size"] > 0) != ""){
$photo = "${user_id}_$rand.jpg";
$target_file = $target_dir . $photo;
$target_file_1 = $target_dir . basename($_FILES["photo"]["name"]);
$imageFileType = strtolower(pathinfo($target_file_1,PATHINFO_EXTENSION));
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
header("location: add_fund.php?msg=Issue with the screenshot(only png/jpg/jpeg supported)");
}else{
if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
$stmt1 = "insert into PAYMENT_QUEUE(USER_ID,AMOUNT,MODE,IMAGE,TIME) values ('$user_id','$amount','$mode','$photo',now())";
$db->query($stmt1);
header("location: add_fund.php?msg=Added in Queue");
}
}
}
?>