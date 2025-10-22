<?php
session_start();
$user_id=$_SESSION['USER_ID'] ?? '';
$admin=$_SESSION['ADMIN'] ?? '';
include "../db.php";
if($user_id=="" || $admin==""){
        header("location: logout.php");
}{
$mobile=$_POST['mobile'] ?? '';
$single=$_POST['single'] ?? '';
$jodi=$_POST['jodi'] ?? '';
$single_patti=$_POST['single_patti'] ?? '';
$double_patti=$_POST['double_patti'] ?? '';
$tripple_patti=$_POST['tripple_patti'] ?? '';
$half_sangam=$_POST['half_sangam'] ?? '';
$full_sangam=$_POST['full_sangam'] ?? '';
$paytm=$_POST['paytm'] ?? '';
$phonepay=$_POST['phonepay'] ?? '';
$gpay=$_POST['gpay'] ?? '';
$starline_price=$_POST['starline_price'] ?? '';
$starline_patti_price=$_POST['starline_patti_price'] ?? '';
$starline_dpatti_price=$_POST['starline_dpatti_price'] ?? '';
$starline_game=$_POST['starline_game'] ?? '';
$guess=$_POST['guess'] ?? '';
$app_name=$_POST['app_name'] ?? '';
$gateway=$_POST['gateway'] ?? '';
$gateway_key=$_POST['gateway_key'] ?? '';
$withdraw_amount=$_POST['withdraw_amount'] ?? '';
$recharge_amount=$_POST['recharge_amount'] ?? '';
$bonus=$_POST['bonus'] ?? '';
$refer=$_POST['refer'] ?? '';
$otp=$_POST['otp'] ?? '';
$otp_key=$_POST['otp_key'] ?? '';
$stmt3="update SETTINGS set OTP='$otp', OTP_KEY='$otp_key', RECHARGE='$recharge_amount' , WITHDRAW='$withdraw_amount', GATEWAY='$gateway', GATEWAY_KEY='$gateway_key', PAYTM='$paytm', PHONEPAY='$phonepay', GPAY='$gpay', MOBILE='$mobile', SINGLE='$single', JODI='$jodi', SINGLE_PATTI='$single_patti', DOUBLE_PATTI='$double_patti', TRIPPLE_PATTI='$tripple_patti', HALF_SANGAM='$half_sangam', FULL_SANGAM='$full_sangam', STARLINE='$starline_price', STARLINE_SINGLE='$starline_patti_price', STARLINE_DOUBLE='$starline_dpatti_price', STARLINE_GAME='$starline_game', GUESS='$guess', APP_NAME='$app_name',  BONUS='$bonus', REFER='$refer';";
$db->query($stmt3);
header("location: settings.php?msg=Updated");
}
?>
