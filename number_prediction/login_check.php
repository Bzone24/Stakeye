<?php

include "db.php";
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$stmt2 = $db->query("select ID, PASSWORD from USERS where EMAIL='$username' or MOBILE='$username';");
while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
    $id = $row2['ID'] ?? '';
    $password_check = $row2['PASSWORD'] ?? '';
}
if (password_verify($password, $password_check)) {
    if ($id != "") {
        session_start();
        $_SESSION['USER_ID'] = $id;
        setcookie("user_id", "$id", time() + 31556926, '/');
        header("location: dashboard.php");
    } else {
        header("location: login.php?msg=Invalid Username/Password");
    }
} else {
    header("location: login.php?msg=Invalid Username/Password");
}
