<?php
session_start();
$user_id=$_SESSION['USER_ID'] ?? '';
$admin=$_SESSION['ADMIN'] ?? '';
if($user_id=="" || $admin==""){
        header("location: logout.php");
}

include "../db.php";
$id=$_POST['id'] ?? '';
$name=$_POST['name'] ?? '';
$time1=$_POST['time1'] ?? '';
$time2=$_POST['time2'] ?? date("H:i");
$holiday=$_POST['holiday'] ?? '';
$closing=$_POST['closing_time'] ?? '';
$jodi_result=$_POST['jodi_result'] ?? '';
$jodi_result=str_replace("'", "\'", $jodi_result);
$panel_result=$_POST['panel_result'] ?? '';
$panel_result=str_replace("'", "\'", $panel_result);
$highlight=$_POST['highlight'] ?? '';
$color=$_POST['color'] ?? '';
$page=str_replace(' ', '', $name);
$page=strtolower("$page");
$days=$_POST['days'] ?? '';
$inactive=$_POST['inactive'] ?? '';
$auto_guess=$_POST['auto_guess'] ?? '';
$linked_game=$_POST['linked_game'] ?? '';

 
if($id==""){
$stmt1 = "insert into GAMES(NAME,TIME1,TIME2,PAGE,GUESS,HIGHLIGHT,JODI_RESULT,PANEL_RESULT,DAYS,AUTO_GUESS,COLOR,PLAY,CLOSING_TIME,linked_game) values ('$name','$time1','$time2','$page','$auto_guess','$highlight','$jodi_result','$panel_result','$days','$auto_guess','$color','checked',$closing,'$linked_game');";
$db->query($stmt1);
header("location: manage_games.php?msg=Added successfully");
}else{
 $stmt1 = "update GAMES set DAYS='$days', NAME='$name', TIME1='$time1', TIME2='$time2', PAGE='$page', GUESS='$guess', HIGHLIGHT='$highlight', HOLIDAY='$holiday', AUTO_GUESS='$auto_guess', COLOR='$color', CLOSING_TIME='$closing', linked_game = '$linked_game' where ID='$id';";
$db->query($stmt1);
if($inactive==""){
$stmt1 = "update GAMES set INACTIVE=NULL where ID='$id';";
$db->query($stmt1);
}else{
$stmt1 = "update GAMES set INACTIVE='$inactive' where ID='$id';";
$db->query($stmt1);
}
header("location: manage_games.php?id=$id&msg=Updated successfully");
}
?>
