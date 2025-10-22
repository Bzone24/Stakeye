<?php
include "../db.php";
$id=$_POST['id'] ?? '';
$result1=$_POST['result1'] ?? '';
$result2=$_POST['result2'] ?? '';
$date=$_POST['date'] ?? '';
$r_id=$_POST['r_id'] ?? '';
if($r_id!=""){
$stmt1 = "update RESULT set RESULT1='$result1', RESULT2='$result2' where GAME_ID='$id' and DATE='$date';";
$db->query($stmt1);
}else{
$stmt1 = "insert into RESULT(RESULT1,RESULT2,GAME_ID,DATE) value ('$result1','$result2','$id','$date');";
$db->query($stmt1);
}

header("location: manage_result.php?msg=Updated successfully");
?>
