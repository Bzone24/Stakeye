<?php

@session_start();

unset($_SESSION['USER_ID']);
unset($_SESSION['NAME']);
unset($_SESSION['ADMIN']);
$_SESSION['ADMIN'] = "ADMIN";

 $_SESSION['USER_ID'] = "1";
        header("location: index.php");
        ?>
