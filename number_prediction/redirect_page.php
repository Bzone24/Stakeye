<?php
$orderId=$_GET['client_txn_id'];
$txn_id=$_GET['txn_id'];
$rand=shell_exec("echo $orderId | cut -d '_' -f1");
$rand=preg_replace("/\s+/", "", $rand);
$user_id=shell_exec("echo $orderId | cut -d '_' -f2");
$user_id = preg_replace("/\s+/", "", $user_id);
$amount=shell_exec("echo $orderId | cut -d '_' -f3");
$amount = preg_replace("/\s+/", "", $amount);
$id=shell_exec("echo $orderId | cut -d '_' -f4");
$id = preg_replace("/\s+/", "", $id);
error_reporting(E_ERROR | E_PARSE);
$echo = "";
include "header.php";
if (isset($_GET['client_txn_id'])) {
	$key = "$gateway_key";	// Your Api Token https://merchant.upigateway.com/user/api_credentials
	$post_data = new stdClass();
	$post_data->key = $key;
	$post_data->client_txn_id = $_GET['client_txn_id']; // you will get client_txn_id in GET Method
	$post_data->txn_date = date("d-m-Y"); // date of transaction

	$curl = curl_init();
	curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://api.ekqr.in/api/check_order_status',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS => json_encode($post_data),
		CURLOPT_HTTPHEADER => array(
			'Content-Type: application/json'
		),
	));
	$response = curl_exec($curl);
	curl_close($curl);

	$result = json_decode($response, true);
	if ($result['status'] == true) {
		// Txn Status = 'created', 'scanning', 'success','failure'

		if ($result['data']['status'] == 'success') {
			$echo = '<div class="alert alert-danger"> Transaction Status : Success</div>';
			$txn_data = $result['data'];
$verify_amount=$result['data']['amount'];
if($amount==$verify_amount){
$stmt2 = $db->query("select  USER_ID, MODE, AMOUNT from PAYMENT_QUEUE where ID='$id' and IMAGE='$rand' and USER_ID='$user_id' and STATUS is NULL;");
while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
{
$user_id1=$row2['USER_ID'] ?? '';
$mode=$row2['MODE'] ?? '';
$amount=$row2['AMOUNT'] ?? '';
}
if($user_id1!=""){
$stmt1 = $db->query("select NAME, MOBILE from USERS where ID='$user_id1';");
while($row1 = $stmt1->fetch(PDO::FETCH_ASSOC))
{
$name=$row1['NAME'] ?? '';
}
$name=str_replace("a","X","$name");
$name=str_replace("e","X","$name");
$name=str_replace("i","X","$name");
$name=str_replace("o","X","$name");
$name=str_replace("u","X","$name");
$name=str_replace("b","X","$name");
$name=str_replace("s","X","$name");
$name=str_replace("g","X","$name");
$stmt1 = "insert into PAYMENTS(NAME,AMOUNT,MODE,DATE) values ('$name','$amount','UPI',now());";
$db->query($stmt1);
$stmt1 = "update USERS set WALLET=WALLET + $amount where ID='$user_id1';";
$db->query($stmt1);
$stmt2 = $db->query("select ID from TRANSACTIONS  where USER_ID='$user_id1' and REMARK='Added';");
while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
{
$first_recharge=$row2['ID'] ?? '';
}
if(@$first_recharge == "" && $bonus_amount > 0){
$stmt1 = "update USERS set WALLET=WALLET + $bonus_amount where ID='$user_id1';";
$db->query($stmt1);
$first_recharge_text=" + Bonus";
}
$stmt2 = $db->query("select WALLET, REFER_BY from USERS where ID='$user_id1';");
while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
{
$balance=$row2['WALLET'] ?? '';
$refer_by=$row2['REFER_BY'] ?? '';
}
$stmt1 = "insert into TRANSACTIONS(USER_ID,DATE_TIME,AMOUNT,BALANCE,REMARK) values ('$user_id1',now(),'$amount','$balance','Added$first_recharge_text');";
$db->query($stmt1);
$stmt1 = "update PAYMENT_QUEUE set STATUS='COMPLETED', TXN_ID='$txn_id' where ID='$id' and IMAGE='$rand' and USER_ID='$user_id' and STATUS is NULL;;";
$db->query($stmt1);

if(@$refer_by!="" && $refer_amount > 0){
$referamount=($amount * $refer_amount) / 100;
$stmt1 = "update USERS set WALLET=WALLET + $referamount where ID='$refer_by';";
$db->query($stmt1);
$stmt2 = $db->query("select WALLET from USERS where ID='$refer_by';");
while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
{
$ref_balance=$row2['WALLET'] ?? '';
}
$stmt1 = "insert into TRANSACTIONS(USER_ID,DATE_TIME,AMOUNT,BALANCE,REMARK) values ('$refer_by',now(),'$referamount','$ref_balance','Bonus');";
$db->query($stmt1);
}
}
}
		}
		$txn_data = $result['data'];
		$echo = '<div class="alert alert-danger"> Transaction Status : ' . $result['data']['status'] . '</div>';
	}
}
?>
<br>
<div class="container-fluid">
<div class="container">
<div class='row'>
        <div class="col-xs-12">
			<?php echo $echo;
				 // show table of response
				?>

                <br><br>
        <br><br><br><br><br><br><br><br><br>
</div>
</div>
</div>
</div>
<?php
include "footer.php";
?>

