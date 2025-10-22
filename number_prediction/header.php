<!DOCTYPE html>
<?php
 
session_start();
$user_id = $_SESSION['USER_ID'] ?? '';
//$user_id=$_COOKIE[user_id];
date_default_timezone_set('Asia/Kolkata');
$domain = $_SERVER['SERVER_NAME'];
$page = basename($_SERVER['SCRIPT_NAME']);
if ($user_id == "") {
    if ($page != "index.php" && $page != "jodi-charts.php" && $page != "login.php" && $page != "registration.php" && $page != "forgot.php" && $page != "forgot1.php") {
        header("location: logout.php");
    } else {
        $SESSION['USER_ID'] = "$user_id";
    }
} else {
        $SESSION['USER_ID'] = "$user_id";
}




include "db.php";
$stmt2 = $db->query("select WALLET, NAME, EMAIL, MOBILE from USERS where ID='$user_id';");
while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
    $wallet_amount = $row2['WALLET'] ?? '';
    $user_name = $row2['NAME'] ?? '';
    $user_email = $row2['EMAIL'] ?? '';
    $user_mobile = $row2['MOBILE'] ?? '';
}
$stmt2 = $db->query("select WITHDRAW, RECHARGE, GATEWAY, GATEWAY_KEY, MOBILE, SINGLE, JODI, SINGLE_PATTI, DOUBLE_PATTI, TRIPPLE_PATTI, HALF_SANGAM, FULL_SANGAM, STARLINE, STARLINE_SINGLE, STARLINE_DOUBLE, STARLINE_GAME, APP_NAME, GUESS, BONUS, REFER from SETTINGS;");
while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
    $recharge_amount = $row2['RECHARGE'] ?? '';
    $withdraw_amount = $row2['WITHDRAW'] ?? '';
    $gateway = $row2['GATEWAY'] ?? '';
    $gateway_key = $row2['GATEWAY_KEY'] ?? '';
    $admin_mobile = $row2['MOBILE'] ?? '';
    $single_price = $row2['SINGLE'] ?? '';
    $jodi_price = $row2['JODI'] ?? '';
    $starline_game = $row2['STARLINE_GAME'] ?? '';
    $app_name = $row2['APP_NAME'] ?? '';
    $guess = $row2['GUESS'] ?? '';
    $bonus_amount = $row2['BONUS'] ?? 0;
    $refer_amount = $row2['REFER'] ?? 0;
}
$page = basename($_SERVER['SCRIPT_NAME']);
$home_active = "";
$andar_active = "";
$cross_active="";
$bahar_active = "";
$dash_active = "";
$jodi_active = "";
$patti_active = "";
$d_patti_active = "";
$t_patti_active = "";
$how_active = "";
$half_active = "";
$full_active = "";
$starline_active = "";
if ($page == "index.php") {
    $home_active = "active";
}
if ($page == "andar.php") {
    $andar_active = "active";
}
if ($page == "bahar.php") {
    $bahar_active = "active";
}
if ($page == "dashboard.php" || $page == "bets.php" || $page == "transactions.php") {
    $dash_active = "active";
}
if ($page == "jodi.php") {
    $jodi_active = "active";
}
if($page=="cross.php"){
    $cross_active="active";
}
if ($page == "how-to-play-matka.php") {
    $how_active = "active";
}
?>
<html lang='en'>
<head>
<meta charset='utf-8'>
<title>Online Number Predition | Number Predition Online</title>
<meta name='description' content=''>
<meta name='keywords' content=''>
<meta http-equiv='X-UA-Compatible' content='IE=edge'>
<meta name='viewport' content='width=device-width, initial-scale=1, user-scalable=1.0, minimum-scale=1.0, maximum-scale=1.0'>
<link rel='icon' type='images/favicon.ico' href='assets/front/images/favicon.ico'>
<link href='assets/front/css/style-all-new.css?v=2' rel='stylesheet' type='text/css'>
<link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.1/css/fontawesome.min.css' rel='stylesheet'>
<script rel='dns-prefetch' src=https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js></script>
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
<style>
.padding-top{padding-top:10%}.padding-bottom{padding-bottom:10%}.white-text{color:#fff!important}.blue-background{background:#DC143C}.text-center{text-align:center}.heading{text-align:center;font-size:20px;background:#DC143C;color:#fff;padding:12px 0;border-radius:4px;margin:0 0 11px 0}.refresh-btn{position: fixed;bottom: 15px;left: 10px;background: black;color: white;padding: 8px;border-radius: 7px;}
</style>
</head>
<body>

<div class='container-fluid'>
<div class='row gold-top-hed'>
<div class='col-lg-6 col-md-6 col-sm-6 col-xs-4'>
<div class='gold-logo'>

<a href='index.php'><img src='assets/front/images/m-logo2.png' alt='satta matka online logo'></a>
</div>
</div>
<div class='col-lg-6 col-md-6 col-sm-6 col-xs-8'>
<div class='gold-login-area'>
<ul>
<?php
if ($user_id == "") {
    //echo "<li><a class='log-inn' href='login.php'><i class='fa fa-lock' aria-hidden='true'></i>Login</a></li>
//<li><a href='registration.php'><i class='fa fa-user' aria-hidden='true'></i>Register</a></li>";
} else {
    echo "<li><a class='btn btn-danger log-inn' href='https://stakeye.com/user/dashboard' style='padding:10px;background:#d9534f;'><i class='fa fa-reply' aria-hidden='true'></i>Back to Dashboard</a></li>";
    echo "<li style='padding-top: 10px;color: #FFBE24;font-size: 18px;font-weight: 700;'> $user_name </li>";
    if ($gateway == "" || $gateway == "MANUAL") {
        //echo "<li><a class='log-inn' href='add_fund.php'><i class='fa fa-plus' aria-hidden='true'></i>Add Fund</a></li>";
    } else {
          //  echo "<li><a class='log-inn' href='pay.php'><i class='fa fa-plus' aria-hidden='true'></i>Add Fund</a></li>";
    }
    echo "<li  style='padding-top: 10px;color: #FFBE24;font-size: 18px;font-weight: 700;' ><a class='log-inn' href='transactions.php'><i class='fa fa-wallet' aria-hidden='true'></i>Rs. $wallet_amount</a></li>";
    //echo "<li><a class='log-inn' href='logout.php'><i class='fa fa-lock-open' aria-hidden='true'></i>Logout</a></li>";
}
?>
</ul>
</div>
</div>
</div>
</div>
<div class='container-fluid'>
<div class='row gold-menu-area'>
<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12' style='margin-top:40px'>
<div class='gold-menu'>
<ul>
<?php
echo "
<li class='$home_active'><a href='index.php'>RESULTS</a></li>
<li class='$andar_active'><a href='andar.php'>INSIDE (A)</a></li>
<li class='$bahar_active'><a href='bahar.php'>OUTSIDE (B)</a></li>
<li class='$jodi_active'><a href='jodi.php'>NUMBERS (J)</a></li>
<li class='$cross_active'><a href='cross.php'>Cross</a></li>
<li class='$dash_active'><a href='bets.php'>MY BETS</a></li>
";
?>
</ul>
</div>
</div>
</div>
</div>
