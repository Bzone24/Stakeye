<?php

session_start();
include "db.php";
$name = $_POST['name'] ?? '';
$password1 = $_POST['password'] ?? '';
$email = $_POST['email'] ?? '';
$mobile = $_POST['mobile'] ?? '';
$email_check = "";
$mobile_check = "";
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $stmt1 = $db->query("select EMAIL from USERS where EMAIL='$email';");
    while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
        $email_check = $row1['EMAIL'] ?? '';
    }
    $stmt1 = $db->query("select MOBILE from USERS where MOBILE='$mobile';");
    while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
        $mobile_check = $row1['MOBILE'] ?? '';
    }
    if ($email_check == "") {
        if ($mobile_check == "") {
            $options = [
            'cost' => 12,
            ];
            $password = password_hash("$password1", PASSWORD_BCRYPT, $options);
            $stmt1 = "insert into USERS(NAME,EMAIL,PASSWORD,MOBILE,WALLET) values ('$name','$email','$password','$mobile','0');";
            $db->query($stmt1);
            header("location: login.php?msg=Thank you!!");
        } else {
            header("location: registration.php?msg=Mobile already Exist");
        }
    } else {
        header("location: registration.php?msg=Email ID already Exist");
    }
} else {
    header("location: registration.php?msg=Invalid Email");
}
