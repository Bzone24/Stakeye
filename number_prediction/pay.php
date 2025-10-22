<?php
include "header.php";
$domain=$_SERVER['SERVER_NAME'];
				if (isset($_POST['payment'])) {
$amount=$_POST['txnAmount'];
$rand=rand();
$stmt1 = "insert into PAYMENT_QUEUE(USER_ID,AMOUNT,MODE,IMAGE,TIME) values ('$user_id','$amount','ONLINE','$rand',now())";
$db->query($stmt1);
$stmt2 = $db->query("select  ID from PAYMENT_QUEUE where IMAGE='$rand' and USER_ID='$user_id' and STATUS is NULL;");
while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
{
$id=$row2['ID'] ?? '';
}
$order_id="${rand}_${user_id}_${amount}_${id}";

					$key = "$gateway_key";	// Your Api Token https://merchant.upigateway.com/user/api_credentials
					$post_data = new stdClass();
					$post_data->key = $key;
					$post_data->client_txn_id = "$order_id"; // you can use this field to store order id;
					$post_data->amount = $_POST['txnAmount'];
					$post_data->p_info = "product_name";
					$post_data->customer_name = "$user_name";
					$post_data->customer_email = "$user_email";
					$post_data->customer_mobile = "$user_mobile";
					$post_data->redirect_url = "https://$domain/redirect_page.php"; // automatically ?client_txn_id=xxxxxx&txn_id=xxxxx will be added on redirect_url

					$curl = curl_init();
					curl_setopt_array($curl, array(
						CURLOPT_URL => 'https://api.ekqr.in/api/create_order',
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
						echo '<script>location.href="' . $result['data']['payment_url'] . '"</script>';
						exit();
					}

					echo '<div class="alert alert-danger">' . $result['msg'] . '</div>';
				}
				?>
<br>
<div class="container-fluid">
<div class="container">
<div class='row'>
        <div class="col-xs-12">
				<h2>Add Fund</h2>
				<span>We accept UPI only:</span>
				<hr>
				<form action="" method="post">
					<h4>Amount:</h4>
					<input type="number" min=<?php echo $recharge_amount;?> name="txnAmount" value="<?php echo $recharge_amount;?>" class="form-control" placeholder="Enter Txn Amount" >
Minimum Amount: <?php echo $recharge_amount;?>
<br><br>
					<input type="submit" name="payment" value="Payment" class="btn btn-danger">
				</form>
		               <br><br>
        <br><br><br>
</div>
</div>
</div>
</div>

		<?php
		include "footer.php";
		?>
