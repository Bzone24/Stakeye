<?php
include "db.php";
$mobile=$_POST['mobile'] ?? '';
$otp=rand(1000,9999);
$stmt1 = "update USERS set PASSWORD='$password' where MOBILE='$mobile';";
$db->query($stmt1);
$stmt1 = "insert into FORGOT(MOBILE,OTP,DATE) values ('$mobile','$otp',now());";
$db->query($stmt1);
$stmt2 = $db->query("select OTP, OTP_KEY from SETTINGS;");
while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
{
$otp=$row2['OTP'] ?? '';
$sms_key=$row2['OTP_KEY'] ?? '';
}
$fields = array(
    "variables_values" => "$otp",
    "route" => "otp",
    "numbers" => "$mobile",
);
$curl = curl_init();
if($otp=="DVGROUP"){
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://dvhosting.in/api-sms-v2.php",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_SSL_VERIFYHOST => 0,
  CURLOPT_SSL_VERIFYPEER => 0,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => json_encode($fields),
  CURLOPT_HTTPHEADER => array(
    "authorization: $sms_key",
    "accept: */*",
    "cache-control: no-cache",
    "content-type: application/json"
  ),
));
}else{
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_SSL_VERIFYHOST => 0,
  CURLOPT_SSL_VERIFYPEER => 0,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => json_encode($fields),
  CURLOPT_HTTPHEADER => array(
    "authorization: $sms_key",
    "accept: */*",
    "cache-control: no-cache",
    "content-type: application/json"
  ),
));
}
$response=curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);

header("location: forgot1.php?mobile=$mobile&msg=OTP sent on mobile");
?>
