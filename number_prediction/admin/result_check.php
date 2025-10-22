<?php
include "../db.php";
$id=$_POST['id'] ?? '';
$r_id=$_POST['r_id'] ?? '';
$result1=$_POST['result1'] ?? '';
$result2=$_POST['result2'] ?? '';
$text=$_POST['text'] ?? '';



if($r_id==""){
$stmt1 = "insert into RESULT(GAME_ID,RESULT1,RESULT2,DATE,REMARK) values ('$id','$result1','0',now(),'$text');";
$db->query($stmt1);
}else{
$stmt1 = "update RESULT set RESULT1='$result1', REMARK='$text' where GAME_ID='$id' and DATE=CURDATE();";
$db->query($stmt1);
}

header("location: manage_result.php?msg=Updated successfully");
?>
