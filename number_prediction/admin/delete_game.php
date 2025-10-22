<?php
session_start();
$user_id=$_SESSION['USER_ID'] ?? '';
$admin=$_SESSION['ADMIN'] ?? '';
include "../db.php";
if($user_id=="" || $admin==""){
        header("location: logout.php");
}
include "../db.php";
$delete_id=$_GET['delete_id'] ?? '';
if($delete_id!=""){
$stmt1 = "delete from GAMES where ID='$delete_id';";
$db->query($stmt1);
$msg="Game Deleted";
}
header("location: manage_games.php");
?>
