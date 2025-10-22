<?php
session_start();
unset($_SESSION['USER_ID']);
unset($_SESSION['NAME']);
unset($_SESSION['ADMIN']);
session_destroy();
header("Location: login.php");
?>
