<?php
session_start();
unset($_SESSION['USER_ID']);
setcookie('user_id', null, -1, '/');
// Unset all of the session variables.

$_SESSION = array();
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

session_destroy();
header("location: https://stakeye.com/");
exit();
header("Location: login.php?msg=Logged out");
?>
