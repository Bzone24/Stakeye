<?php
include "../db.php";
$id=$_POST['id'] ?? '';
$open1=$_POST['open1'] ?? '';
$open2=$_POST['open2'] ?? '';
$open3=$_POST['open3'] ?? '';
$open4=$_POST['open4'] ?? '';
$jodi1=$_POST['jodi1'] ?? '';
$jodi2=$_POST['jodi2'] ?? '';
$jodi3=$_POST['jodi3'] ?? '';
$jodi4=$_POST['jodi4'] ?? '';
$jodi5=$_POST['jodi5'] ?? '';
$jodi6=$_POST['jodi6'] ?? '';
$jodi7=$_POST['jodi7'] ?? '';
$jodi8=$_POST['jodi8'] ?? '';
$patti1=$_POST['patti1'] ?? '';
$patti2=$_POST['patti2'] ?? '';
$patti3=$_POST['patti3'] ?? '';
$patti4=$_POST['patti4'] ?? '';
$date=$_POST['date'] ?? '';
$stmt1 = $db->query("select ID from FREE_GAME  where GAME_ID='$id';");
        while($row1 = $stmt1->fetch(PDO::FETCH_ASSOC))
        {
                $check_id=$row1['ID'] ?? '';
}
if(@$check_id==""){
$stmt1 = "insert into FREE_GAME (DATE, GAME_ID,WHICH_ONE) values (now(),'$id','OPEN');";
$db->query($stmt1);
$stmt1 = "insert into FREE_GAME (DATE, GAME_ID,WHICH_ONE) values (now(),'$id','JODI');";
$db->query($stmt1);
$stmt1 = "insert into FREE_GAME (DATE, GAME_ID,WHICH_ONE) values (now(),'$id','PATTI');";
$db->query($stmt1);
}
$stmt1 = "update FREE_GAME set FIRST='$open1', SECOND='$open2', THIRD='$open3', FORTH='$open4' where GAME_ID='$id' and WHICH_ONE='OPEN';";
$db->query($stmt1);
$stmt1 = "update FREE_GAME set FIRST='$jodi1', SECOND='$jodi2', THIRD='$jodi3', FORTH='$jodi4', FIFTH='$jodi5', SIXTH='$jodi6', SEVEN='$jodi7', EIGHT='$jodi8' where GAME_ID='$id' and WHICH_ONE='JODI';";
$db->query($stmt1);
$stmt1 = "update FREE_GAME set FIRST='$patti1', SECOND='$patti2', THIRD='$patti3', FORTH='$patti4' where GAME_ID='$id' and WHICH_ONE='PATTI';";
$db->query($stmt1);
header("location: manage_guess.php?date=$date&msg=Updated successfully");
?>
