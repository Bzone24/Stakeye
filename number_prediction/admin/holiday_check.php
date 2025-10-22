<?php
session_start();
$user_id=$_SESSION['USER_ID'] ?? '';
$admin=$_SESSION['ADMIN'] ?? '';
if($user_id=="" || $admin==""){
        header("location: logout.php");
}

include "../db.php";

$stmt1 = "update GAMES set HOLIDAY=NULL;";
$db->query($stmt1);

foreach($_POST as $key => $value) {
$string=explode('_', $key);
$game = "$string[1]";
//echo "$game = $value <br>";
$stmt1 = "update GAMES set HOLIDAY='$value' where ID='$game';";
$db->query($stmt1);
}

header("location: manage_games.php?id=$id&msg=Updated successfully");
?>

