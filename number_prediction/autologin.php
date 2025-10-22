<?php

@session_start();
unset($_SESSION['USER_ID']);
unset($_SESSION['NAME']);
unset($_SESSION['ADMIN']); 
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $_SESSION['USER_ID'] = $id;
    setcookie("user_id", "$id", time() + 31556926, '/');
    header("location: dashboard.php");
} else {
    header("location: https://stakeye.com/");
    exit();
}
